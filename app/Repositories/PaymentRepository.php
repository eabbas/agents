<?php

namespace App\Repositories;


use App\Interfaces\PaymentRepositoryInterface;
use App\Http\Strategy\Payments\Mellat;
use App\Models\Order;
use App\Models\Transaction;
use App\Services\PaymentService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class PaymentRepository implements PaymentRepositoryInterface
{

    /**
     * request new payment
     * @param PaymentService $paymentService
     * @param $amount
     * @return Response|JsonResponse|Application|ResponseFactory
     */
    public function request(PaymentService $paymentService, $amount): Response|JsonResponse|Application|ResponseFactory
    {
        $transaction = new Transaction;
        $transaction->agent_id = auth()->user()->id;;
        $transaction->user_ip = request()->ip();
        $transaction->amount = $amount;
        $transaction->wallet_id = auth()->user()->wallet()->id;
        $transaction->sale_order_id = auth()->user()->id . time();

        if (!$transaction->save()) abort('', 500);

        try {
            // request and store in database
            $response = $paymentService
                ->getPaymentMethod()
                ->request($amount, $transaction, request()->has('wallet'));
        } catch (Exception $e) {
            $this->handleException($e, $transaction);
        }

        return true ?
            response()->json($response) :
            response('', 500);
    }

    /**
     * request new payment with order id
     * @param PaymentService $paymentService
     * @param int $amount
     * @param Transaction $transaction
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function requestByTransaction(PaymentService $paymentService, int $amount, Transaction $transaction): Application|ResponseFactory|JsonResponse|Response
    {
        $response = [];
        try {
            // request and store in database
            $response = $paymentService
                ->getPaymentMethod()
                ->request($amount, $transaction, false);
        } catch (Exception $e) {
            $this->handleException($e, $transaction);
        }

        return true ?
            response()->json($response) :
            response('', 500);
    }

    private function handleException(Exception $e, $transaction)
    {
        $transaction->update([
            'status' => 'failed',
            'description' => $e->getMessage()
        ]);
    }

    /**
     * handle callback from bank
     * @param PaymentService $paymentService
     * @return RedirectResponse
     */
    public function callback(PaymentService $paymentService): RedirectResponse
    {
        return $paymentService
            ->getPaymentMethod()
            ->handleCallback(request());
    }

    /**
     * show payment by id
     * @param Transaction $transaction
     * @return Application|Factory|View
     */
    public function show(Transaction $transaction): View|Factory|Application
    {
        $data = [
            'transaction' => $transaction,
        ];

        // TODO : remove zarinpal, test
        $data['payment_methods'] = [
            [
                'name' => Mellat::getName(),
                'image' => Mellat::getImagePath()
            ],
            [
                'name' => 'zarinpal',
                'image' => 'https://www.drupal.org/files/project-images/zarinpal.png',
            ]
        ];

        return view('payments.show')->with($data);
    }
}
