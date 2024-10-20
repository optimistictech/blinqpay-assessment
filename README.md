Blinqpay Payment Router

A customizable payment routing package for Laravel that enables you to route payments to the best payment processor based on availability, fees, and supported currencies.

Table of Contents

Installation

Configuration

Usage

Available Processors

Extending the Package

Contributing

License

Installation

To install the package, use Composer:

bash

Copy code

composer require blinqpay/payment-router

If you are using Laravel 5.4 or below, you will need to add the service provider to your config/app.php file:

php

Copy code

'providers' => \\\[

// Other service providers...

Blinqpay\\\\PaymentRouter\\\\PaymentRouterServiceProvider::class,

\\\],

For Laravel 5.5+ the service provider will be automatically discovered.

Configuration

To publish the package configuration, run the following command:

bash

Copy code

php artisan vendor:publish --provider="Blinqpay\\\\PaymentRouter\\\\PaymentRouterServiceProvider"

This will create a config/paymentrouter.php file where you can configure your payment processors.

Example Configuration

Here's a sample configuration file (config/paymentrouter.php):

php

Copy code

return \\\[

'default\\\_processor' => 'paystack',

'processors' => \\\[

'paystack' => \\\[

'name' => 'Paystack',

'fees' => 2.5,

'active' => true,

'supported\\\_currencies' => \\\['NGN', 'USD', 'EUR', 'GBP'\\\],

\\\],

'flutterwave' => \\\[

'name' => 'Flutterwave',

'fees' => 3,

'active' => true,

'supported\\\_currencies' => \\\['NGN', 'USD', 'EUR'\\\],

\\\],

\\\],

\\\];

Usage

To use the PaymentRouter in your code, simply retrieve it from the Laravel service container and call the route method:

php

Copy code

use Blinqpay\\\\PaymentRouter\\\\PaymentRouter;

// Get the PaymentRouter instance

$router = app(PaymentRouter::class);

// Route a payment

$result = $router->route(100, 'NGN', 'Payment for Order #123');

// Output the result

echo $result; // Processed 100 NGN with Paystack. Payment for Order #123

The router will automatically select the payment processor with the lowest fees that supports the given currency.

Available Processors

The package currently supports the following processors:

PaystackProcessor: A processor with a fee of 2.5% and support for multiple currencies.

FlutterwaveProcessor: A processor with a fee of 3% and support for multiple currencies.

Extending the Package

You can easily extend the package by adding more processors. To create a custom payment processor, implement the PaymentProcessor interface:

php

Copy code

use Blinqpay\\\\PaymentRouter\\\\Contracts\\\\PaymentProcessor;

class CustomProcessor implements PaymentProcessor

{

public function process($amount, $currency, $details)

{

return "Processed $amount $currency with CustomProcessor. $details";

}

public function supportsCurrency($currency)

{

return in\\\_array($currency, \\\['NGN', 'USD'\\\]);

}

public function isAvailable()

{

return true;

}

public function fees()

{

return 1.5;

}

}

Register your custom processor in the PaymentRouterServiceProvider:

php

Copy code

$router->registerProcessor(new CustomProcessor());

Contributing

Contributions are welcome! If you find a bug or have a feature request, please open an issue or submit a pull request.

Running Tests

To run the tests for this package, use:

bash

Copy code

./vendor/bin/phpunit

License

This package is open-source software licensed under the MIT license.
