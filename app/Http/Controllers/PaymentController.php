<?php

namespace App\Http\Controllers;

use App\Repositories\PaymentRepository;
use App\Models\Transaction;
use App\Services\PaymentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class PaymentController extends Controller
{

    protected PaymentRepository $repository;

    /**
     * @param PaymentRepository $repository
     */
    public function __construct(PaymentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Request new payment
     * @param PaymentService $paymentService
     * @param $amount
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function request(PaymentService $paymentService, $amount)
    {
        return $this->repository->request($paymentService, $amount);
    }

    /**
     * Request new payment
     * @param PaymentService $paymentService
     * @param int $amount
     * @param Transaction $transaction
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function requestByTransaction(PaymentService $paymentService, int $amount, Transaction $transaction)
    {
        return $this->repository->requestByTransaction($paymentService, $amount, $transaction);
    }

    /**
     * handle bank callback
     * @param PaymentService $paymentService
     * @return RedirectResponse
     */
    public function callback(PaymentService $paymentService)
    {
        return $this->repository->callback($paymentService);
    }

    /**
     * show payment by id
     * @param Transaction $transaction
     * @return Application|Factory|View
     */
    public function show(Transaction $transaction)
    {
        return $this->repository->show($transaction);
    }
}
