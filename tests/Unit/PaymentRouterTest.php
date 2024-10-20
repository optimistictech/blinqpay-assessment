<?php

namespace Tests\Unit;

use Blinqpay\PaymentRouter\PaymentRouter;
use Tests\TestCase;

class PaymentRouterTest extends TestCase
{

    public function test_it_routes_to_the_processor_with_lowest_fees()
    {

          // Retrieve the PaymentRouter instance from the Laravel service container
          $router = app(PaymentRouter::class);

          // Call the route method
          $processor = $router->route(100, 'NGN', 'Payment for Order #123');

          // Assert that the Paystack processor (lowest fees) is selected
          $this->assertEquals('Processed 100 NGN with Paystack. Payment for Order #123', $processor);
    }



    public function test_it_throws_exception_if_no_processors_are_active()
    {

        // Expect an exception to be thrown when no processors are active
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('No available payment processor found.');

        // Initialize the PaymentRouter instance
        $router = new PaymentRouter();

        // Attempt to route the payment
        $router->route(100, 'USD', 'payment');
    }
}
