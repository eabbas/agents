<?php

namespace App\Http\Strategy\Payments;

use App\Interfaces\PaymentMethodStrategy;
use App\Models\Transaction;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\RedirectResponse;
use Validator;

class Mellat implements PaymentMethodStrategy
{
    private \App\Services\Payments\Mellat $api;
    public static string $name = 'mellat';
    public static string $imageName = 'mellat.jpg';

    public function __construct()
    {
        $this->api = new \App\Services\Payments\Mellat(
            config('services.mellat.terminalId'),
            config('services.mellat.username'),
            config('services.mellat.password'),
            route('payment.callback') . '?method=' . self::$name,
        );
    }

    /**
     * Get method name
     * @return string name
     */
    public static function getName(): string
    {
        return self::$name;
    }

    /**
     * Get method image path
     * @return string path
     */
    public static function getImagePath(): string
    {
        return asset('assets/images/payment/' . self::$imageName);
    }

    /**
     * Request payment and store transaction in database
     * @throws Exception
     */
    public function request($amount, $transaction, $chargeWallet): array
    {
        if (($transaction !== null && $transaction->ref_id == null) || $transaction == null) {
            $refId = $this->api->payRequest($amount, $transaction->sale_order_id);
            $transaction->update([
                'ref_id' => $refId,
                'payment_method' => 'mellat',
            ]);
        }

        return [
            'gateway' => $this->api->gatewayURL(),
            'method' => 'post',
            'inputs' => [
                'RefId' => $transaction->ref_id
            ]
        ];
    }


    /**
     * handle callback request
     * @param $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function handleCallback($request): RedirectResponse
    {

        // validate callback request
        $validator = Validator::make($request->all(), [
            'RefId' => 'required',
            'ResCode' => 'required',
            'SaleOrderId' => 'required',
            'SaleReferenceId' => 'required',
            'CardHolderInfo' => 'required',
            'CardHolderPan' => 'required',
        ]);

        if ($validator->fails()) abort(403);

        $validated = $validator->validated();

        $refId = $validated['RefId'];
        $resCode = $validated['ResCode'];
        $saleOrderId = $validated['SaleOrderId'];
        $saleReferenceId = $validated['SaleReferenceId'];
        $cardHolderInfo = $validated['CardHolderInfo'];
        $cardHolderPan = $validated['CardHolderPan'];

        // find transaction
        $transaction = Transaction::whereRefId($refId)->first();

        // check if transaction exist
        if ($transaction == null || $transaction->count() == 0) {
            abort(403);
        }

        // verify and update
        if ($transaction->status == 'unpaid' && !$transaction->verified) {

            $verify = $resCode == 0 ? $this->api->verifyRequest($transaction->sale_order_id, $saleOrderId, $saleReferenceId) : $resCode;

            $update = $transaction->update([
                'status' => $verify == 0 ? 'success' : 'failed',
                'res_code' => $verify,
                'sale_reference_id' => $saleReferenceId,
                'card_info' => $cardHolderInfo,
                'card_pan' => $cardHolderPan,
            ]);

            // abort if transaction update failed
            if (!$update) abort(500);

            // charge wallet
            if ($transaction->wallet_id !== null && $verify == 0) {
                Wallet::chargeWallet($transaction->wallet_id, $transaction->amount);
            }
        }

        return response()->redirectTo(route('payment.show', ['transaction' => $transaction ?? 0]));
    }
}
