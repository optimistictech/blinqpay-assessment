<?php

namespace Blinqpay\PaymentRouter;

use Blinqpay\PaymentRouter\Processors\FlutterwaveProcessor;
use Illuminate\Support\ServiceProvider;
use Blinqpay\PaymentRouter\Processors\PaystackProcessor;

class PaymentRouterServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register the PaymentRouter singleton
        $this->app->singleton(PaymentRouter::class, function ($app) {
            $router = new PaymentRouter();

            // Register the available processors with the router
            $router->registerProcessor(new PaystackProcessor());
            $router->registerProcessor(new FlutterwaveProcessor());

            return $router;
        });

    }

}
