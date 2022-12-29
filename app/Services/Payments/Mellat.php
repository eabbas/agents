<?php

namespace App\Services\Payments;

use Exception;
use SoapClient;
use SoapFault;

class  Mellat
{
    private string $wsdlURL = 'https://banktest.ir/gateway/bpm.shaparak.ir/pgwchannel/services/pgw?wsdl';
    private string $gatewayURL = 'https://banktest.ir/gateway/pgw.bpm.bankmellat.ir/pgwchannel/startpay.mellat';
    private SoapClient $client;

    private int $terminalId;
    private string $username;
    private string $password;
    private string $callbackURL;

    public function __construct(int $terminalId, $username, $password, $callbackURL)
    {
        $this->terminalId = $terminalId;
        $this->username = $username;
        $this->password = $password;
        $this->callbackURL = $callbackURL;
    }

    /**
     * @throws Exception
     */
    public function soapClient(): SoapClient
    {
        try {
            $this->client = $this->client ?? new SoapClient($this->wsdlURL);
            return $this->client;
        } catch (SoapFault $e) {
            throw new Exception('SoapFault: ' . $e->getMessage() . ' | ' . $e->getCode(), $e->getCode());
        }
    }

    /**
     * Send payment request and return refId
     * @throws Exception
     */
    public function payRequest(int $amount, int $saleOrderId, $additionalData = ''): string
    {
        $response = $this->handleResponse($this->soapClient()->bpPayRequest([
            'terminalId' => $this->terminalId,
            'userName' => $this->username,
            'userPassword' => $this->password,
            'orderId' => $saleOrderId,
            'amount' => $amount,
            'localDate' => date('Ymd'),
            'localTime' => date('His'),
            'additionalData' => $additionalData,
            'callBackUrl' => $this->callbackURL,
            'payerId' => 0
        ]));

        $code = $response[0];

        return $code == 0 ?
            $response[1] :
            throw new Exception(__('mellat.error.' . $code));
    }

    /**
     * @throws Exception
     */
    public function verifyRequest($orderId, $saleOrderId, $saleReferenceId): int
    {
        $response = $this->handleResponse($this->soapClient()->bpVerifyRequest([
            'terminalId' => $this->terminalId,
            'userName' => $this->username,
            'userPassword' => $this->password,
            'orderId' => $orderId,
            'saleOrderId' => $saleOrderId,
            'saleReferenceId' => $saleReferenceId
        ]));

        return $response[0];
    }

    /**
     * explode response and return as array
     * handle errors
     * @throws Exception
     */
    public function handleResponse($response): array
    {
        if (!isset($response->return))
            throw new Exception(trans('mellat.error.0'));

        return explode(',', $response->return);
    }

    /**
     * Return gateway url
     * @return string
     */
    public function gatewayURL(): string
    {
        return $this->gatewayURL;
    }
}
