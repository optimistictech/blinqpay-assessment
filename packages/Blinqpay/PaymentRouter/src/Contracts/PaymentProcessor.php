<?php
namespace Blinqpay\PaymentRouter\Contracts;

interface PaymentProcessor
{
    public function process($amount, $currency, $details);
    public function supportsCurrency($currency);
    public function isAvailable();
    public function fees();
}
