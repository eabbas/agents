<?php

namespace App\Repositories;

use App\DataTables\ClientOrdersDataTable;
use App\DataTables\ClientsDataTable;
use App\Interfaces\ClientRepositoryInterface;
use App\Http\Requests\Client\StoreCompanyRequest;
use App\Http\Requests\Client\StorePersonalRequest;
use App\Http\Requests\Client\UpdateCompanyRequest;
use App\Http\Requests\Client\UpdatePersonalRequest;
use App\Models\Address;
use App\Models\Client;
use App\Models\Kit;
use App\Models\Order;
use App\Models\Phone;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Notifications\PaymentURLSms;
use Carbon\Carbon;
use Excel;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Validator;

class ClientRepository implements ClientRepositoryInterface
{

    public function index(ClientsDataTable $dataTable)
    {
        return $dataTable->response(function (Collection $response) {
            $response['data'] = collect($response['data'])->map(function ($data) {
                $data['created_at'] = piry_gregorian_to_jalali(Carbon::parse($data['created_at']));
                $data['updated_at'] = piry_gregorian_to_jalali(Carbon::parse($data['updated_at']));
                return $data;
            })->toArray();
            return $response;
        })->render('panel.clients.index');
    }

    /**
     * Create natural person client
     * @param StorePersonalRequest $request
     * @return Client|bool|Builder
     */
    public function createPersonalClient(StorePersonalRequest $request): Client|Builder|bool
    {
        $data = $request->validated();
        // assign fullname for personal form
        $data['full_name'] = $data['name'] . ' ' . $data['family'];

        return $this->createClient($data);
    }

    /**
     * Create legal client
     * @param StoreCompanyRequest $request
     * @return Client|Builder|bool
     */
    public function createCompanyClient(StoreCompanyRequest $request): Client|Builder|bool
    {
        $data = $request->validated();
        // add legal type
        $data['type'] = 'legal';

        return $this->createClient($data);
    }

    /**
     * Create client
     * @param array $data
     * @return Client|Builder|bool
     */
    private function createClient(array $data): Client|Builder|bool
    {
        // separate phones and addresses from data
        $phones = $data['phones'] ?? [];
        $addresses = $data['addresses'] ?? [];
        $this->removeFromArrayIfExist($data, ['phones', 'addresses']);

        // assign agent username
        $data['agent_username'] = request()->user()->username;

        // create client
        $client = Client::create($data);

        // store phones and addresses in database and return response
        return $client->wasRecentlyCreated &&
            Phone::storePhones($phones, $client) &&
            Address::storeAddresses($addresses, $client) ? $client : false;
    }

    /**
     * Update legal client
     * @param UpdateCompanyRequest $request
     * @param Client $client
     */
    public function updateCompany(UpdateCompanyRequest $request, Client $client)
    {
        return $this->updateClient($request->validated(), $client) ?
            redirect()->back() :
            redirect()->back()->withErrors(['error' => __('خطا در ثبت اطلاعات')]);
    }

    /**
     * Update real client
     * @param UpdatePersonalRequest $request
     * @param Client $client
     */
    public function updatePersonal(UpdatePersonalRequest $request, Client $client)
    {
        return $this->updateClient($request->validated(), $client) ?
            redirect()->back() :
            redirect()->back()->withErrors(['error' => __('خطا در ثبت اطلاعات')]);
    }

    /**
     * Create client
     * @param array $data
     */
    private function updateClient(array $data, Client $client)
    {
        // separate phones and addresses from data
        $phones = $data['phones'] ?? [];
        $addresses = $data['addresses'] ?? [];
        $this->removeFromArrayIfExist($data, ['phones', 'addresses']);

        // store phones and addresses in database and return response
        try {
            $client->update($data);
            Phone::storePhones($phones, $client, true);
            Address::storeAddresses($addresses, $client, true);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function sendPaymentURL(Request $request): Application|ResponseFactory|Response
    {
        //$data = $request->all();
        $data = json_decode($request->getContent(), true);
        $rules = [
            'product_id' => 'numeric|required', //Must be a number and length of value is 8
            'kits' => 'array',
            'client_id' => 'required|exists:clients,id',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {

            $validated = $validator->validated();
            $client = Client::whereId($validated['client_id'])->first();

            if ($client->phones()->count() > 0) {
                // get phone number of client
                $phone = $client->phones()->first();

                // TODO: generate url here and send
                $url = "https://example.com/user/invoice/121231";
                $phone->notify(new PaymentURLSms($url));
                return response('', 200);
            }

            return response('', 404);
        }

        return response('', 422);
    }


    /**
     * handle pay request ( bank, wallet )
     * @param Client $client
     * @param Request $request
     * @return mixed
     */
    public function pay(Client $client, Request $request): mixed
    {
        $data = json_decode($request->getContent(), true);

        $rules = [
            'product_id' => 'numeric|required',
            'kits' => 'array',
            'wallet_id' => 'numeric|exists:wallets,id',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            $validated = $validator->validated();
            $transaction = $this->processPayment($validated, $client);

            return $transaction ?
                response()->json(['payment_url' => route('payment.show', $transaction->id), 'success' => true]) :
                response('something went wrong', 500);
        }
        return response('', 422);
    }

    /**
     * process payment
     */
    private function processPayment($validated, $client): Model|Transaction|null
    {

        // get product
        $product = Product::whereId($validated['product_id'])->first();

        // get kits as array
        $kits = collect($validated['kits'])->map(function ($id) {
            return Kit::whereId($id)->first();
        });

        // calculate price
        $price_all = $this->calulateModelsPrice([...$kits, $product]);

        // store order in database
        $order = $this->createOrder($client, $price_all, $kits, $product);

        // if order created successfully
        if ($order->wasRecentlyCreated) {
            // store transaction in database
            $transaction = $this->createTransaction($client, $order, $price_all, $validated['wallet_id'] ?? null);

            // if transaction created successfully & process wallet payment if wallet_id set in input
            if ($transaction->wasRecentlyCreated && $this->processWalletPayment($transaction, $order, $validated, $price_all)) {
                return $transaction;
            }

            // delete order if process failed
            $order->delete();
            $transaction->delte();
        }

        return null;
    }

    /**
     * process wallet payment
     */
    private function processWalletPayment($transaction, $order, $validated, $price)
    {
        if (isset($validated['wallet_id'])) {
            $wallet = Wallet::whereId($validated['wallet_id'])->first();

            if ($wallet->exists() && $wallet->agent_id == auth()->user()->id) {

                // check balance & abort if balance is not enough
                if ($wallet->balance < $price) {

                    $transaction->delete();
                    $order->delete();

                    abort(response()->json([
                        'message' => trans('payment.error.low-balance'),
                        'success' => false
                    ]));
                }

                $wallet->balance = $wallet->balance - $price;
                $transaction->status = 'success';
                return $wallet->save() && $transaction->save();
            }

            return false;
        }
        return true;
    }

    /**
     * store order in database
     * @param $client
     * @param $price
     * @param $kits
     * @param $product
     * @return Order
     */
    private function createOrder(Client $client, $price, $kits, Product $product)
    {
        $order = new Order;
        $order->client_id = $client->id;
        $order->agent_id = $client->agent_id;
        $order->price = $price;
        $order->kits = $kits;
        $order->product_id = $product->id;

        $order->save();
        return $order;
    }

    /**
     * store transaction in database
     * @param $client
     * @param $order
     * @param $price
     * @param $wallet_id
     * @return Transaction
     */
    private function createTransaction($client, $order, $price, $wallet_id = null)
    {

        $transaction = new Transaction;
        $transaction->agent_id = $client->agent_id;
        $transaction->client_id = $client->id;
        $transaction->order_id = $order->id;
        $transaction->user_ip = request()->ip();
        $transaction->amount = $price;
        $transaction->wallet_id = $wallet_id;
        $transaction->sale_order_id = auth()->user()->id . time();

        $transaction->save();
        return $transaction;
    }

    /**
     * calculate product and kits total price
     * @param array $models
     * @return int
     */
    private function calulateModelsPrice(array $models): int
    {
        $price = 0;

        foreach ($models as $model) {
            if (!$model->exists()) abort(500, 'there is problem with product or kits id');
            $price += $model->price;
        }

        return $price;
    }

    /**
     * get kits
     * @param Client $client
     * @param Product $product
     * @return array
     */
    public function getKits(Client $client, Product $product): array
    {
        return $product->kits()->get()->toArray();
    }

    /**
     * return client details view
     * @param Client $client
     * @param ClientOrdersDataTable $dataTable
     */
    public function details(Client $client, ClientOrdersDataTable $dataTable)
    {
        $data['client'] = $client;
        return $dataTable->render('panel.clients.details', $data);
    }

    /**
     * return order index view
     * @param Client $client
     * @return Factory|View|Application
     */
    public function orderIndex(Client $client): Factory|View|Application
    {
        $data['products'] = Product::with('kits')->get();
        $data['client'] = $client;
        return view('panel.clients.order', $data);
    }

    /**
     * return create view
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('panel.clients.create');
    }

    public function destroy(Client $client)
    {
        return $client->delete() ?
            response('', 200) :
            response('', 500);
    }

    public function edit(Client $client)
    {
        return view('panel.clients.edit', compact('client'));
    }

    /**
     * @param array $array
     * @param $keys
     * @return void
     */
    private function removeFromArrayIfExist(array &$array, $keys): void
    {
        foreach ($keys as $key) {
            if (isset($array[$key])) unset($array[$key]);
        }
    }
}
