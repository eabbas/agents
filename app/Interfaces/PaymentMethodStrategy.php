<?php

namespace App\Interfaces;

use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;

interface PaymentMethodStrategy
{

    /**
     * request payment and store transaction in database
     * @param $amount
     * @param $orderId
     * @param $chargeWallet
     * @return array
     */
    public function request($amount, Transaction $transaction, bool $chargeWallet): array;

    /**
     * handle callback and redirect to payment page
     * @param $request
     * @return RedirectResponse
     */
    public function handleCallback($request): RedirectResponse;
}
