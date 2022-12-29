<?php

namespace App\Interfaces;


use App\Models\Transaction;
use App\Services\PaymentService;

interface PaymentRepositoryInterface
{
    public function request(PaymentService $paymentService, $amount);

    public function requestByTransaction(PaymentService $paymentService, int $amount, Transaction $transaction);

    public function callback(PaymentService $paymentService);

    public function show(Transaction $transaction);
}
