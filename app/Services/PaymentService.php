<?php

namespace App\Services;

use App\Http\Interfaces\PaymentMethod;

class PaymentService
{

    /**
     * @var PaymentMethod
     */
    private mixed $method;

    public function __construct()
    {
        $methodClassName = ucfirst(
            request()->query('method', 'mellat')
        );

        $class = "App\Http\Strategy\Payments\\$methodClassName";
        $this->method = new $class();
    }

    public function getPaymentMethod()
    {
        return $this->method;
    }
}
