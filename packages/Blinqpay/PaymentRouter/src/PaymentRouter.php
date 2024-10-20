<?php

namespace Blinqpay\PaymentRouter;

use Exception;
use Blinqpay\PaymentRouter\Contracts\PaymentProcessor;

class PaymentRouter
{
    protected $processors = [];


    public function registerProcessor(PaymentProcessor $processor)
    {
        $this->processors[] = $processor;
    }


    public function route($amount, $currency, $details)
    {

        $lowestFees = PHP_INT_MAX;
        $selectedProcessor = null;

        foreach ($this->processors as $processor) {
            // Check if the processor is active, supports the currency, and has lower fees than the current lowest
            if ($processor->isAvailable() && $processor->supportsCurrency($currency) && $processor->fees() < $lowestFees) {

                $lowestFees = $processor->fees();
                $selectedProcessor = $processor;
            }
        }


        // If a processor was selected, process the payment
        if ($selectedProcessor) {
            return $selectedProcessor->process($amount, $currency, $details);
        }

        // If no suitable processor is found, throw an exception
        throw new Exception("No available payment processor found.");
    }
}
