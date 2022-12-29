<?php

namespace App\Http\Controllers\Agent;

use App\DataTables\ClientOrdersDataTable;
use App\DataTables\ClientsDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\ClientRepository;
use App\Http\Requests\Client\StoreCompanyRequest;
use App\Http\Requests\Client\StorePersonalRequest;
use App\Http\Requests\Client\UpdateCompanyRequest;
use App\Http\Requests\Client\UpdatePersonalRequest;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{

    private ClientRepository $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->setTitle('مشتریان');
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(ClientsDataTable $dataTable)
    {
        return $this->repository->index($dataTable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Factory|View|Application
    {
        return $this->repository->create();
    }

    /**
     * edit client
     * @param Client $client
     */
    public function edit(Client $client)
    {
        return $this->repository->edit($client);
    }

    /**
     * delete client
     * @param Client $client
     */
    public function destroy(Client $client)
    {
        return $this->repository->destroy($client);
    }

    /**
     * Show client details
     * @param Client $client
     * @param ClientOrdersDataTable $dataTable
     */
    public function details(Client $client, ClientOrdersDataTable $dataTable)
    {
        return $this->repository->details($client, $dataTable);
    }

    /**
     * Show order index
     * @param Client $client
     */
    public function orderIndex(Client $client)
    {
        return $this->repository->orderIndex($client);
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function sendPaymentURL(Request $request): Application|ResponseFactory|Response
    {
        return $this->repository->sendPaymentURL($request);
    }

    /**
     * @param Client $client
     * @param Product $product
     * @return array
     */
    public function getKits(Client $client, Product $product)
    {
        return $this->repository->getKits($client, $product);
    }

    /**
     * handle paynment
     * @param Client $client
     * @param Request $request
     * @return void
     */
    public function pay(Client $client, Request $request)
    {
        return $this->repository->pay($client, $request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePersonalRequest $request
     * @return RedirectResponse
     */
    public function savePersonal(StorePersonalRequest $request): RedirectResponse
    {
        $client = $this->repository->createPersonalClient($request);

        return $client ?
            redirect()->route('agent.clients.order.index', ['client' => $client]) :
            redirect()->back()->withErrors(['failed' => true])->withInput($request->input());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanyRequest $request
     * @return RedirectResponse
     */
    public function saveCompany(StoreCompanyRequest $request): RedirectResponse
    {
        $client = $this->repository->createCompanyClient($request);

        return $client ?
            redirect()->route('agent.clients.order.index', ['client' => $client]) :
            redirect()->back()->withErrors(['failed' => true])->withInput($request->input());
    }

    /**
     * Update legal client
     * @param UpdateCompanyRequest $request
     * @param Client $client
     */
    public function updateCompany(UpdateCompanyRequest $request, Client $client)
    {
        return $this->repository->updateCompany($request, $client);
    }

    /**
     * Update real client
     * @param UpdatePersonalRequest $request
     * @param Client $client
     */
    public function updatePersonal(UpdatePersonalRequest $request, Client $client)
    {
        return $this->repository->updatePersonal($request, $client);
    }
}
