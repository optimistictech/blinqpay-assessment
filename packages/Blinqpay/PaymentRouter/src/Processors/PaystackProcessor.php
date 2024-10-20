<?php

namespace Blinqpay\PaymentRouter\Processors;

use Blinqpay\PaymentRouter\Contracts\PaymentProcessor;

class PaystackProcessor implements PaymentProcessor
{

    protected $supportedCurrencies = ['NGN','USD', 'EUR', 'GBP'];
    protected $available = true;
    protected $fees = 2.5;

    public function process($amount, $currency, $details)
    {
        return "Processed $amount $currency with Paystack. $details";
    }

    public function supportsCurrency($currency)
    {
        return in_array($currency,  $this->supportedCurrencies);
    }

    public function isAvailable()
    {
        return $this->available;
    }
    public function fees()
    {
        return $this->fees;
    }
}
