# Blinqpay Payment Router

A customizable payment routing package for Laravel that helps route payments to the best payment processor based on availability, fees, and supported currencies.

## Table of Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Available Processors](#available-processors)
- [License](#license)

## Installation

To install the package, use Composer:

```bash
composer require blinqpay/payment-router
```
If you are using Laravel 5.4 or below, you will need to add the service provider manually to your config/app.php file:

```bash
'providers' => [
    // Other service providers...
    Blinqpay\PaymentRouter\PaymentRouterServiceProvider::class,
],
```
For Laravel 5.5+ the service provider will be automatically discovered.
## Table of Contents
To publish the package configuration, run the following command:
```bash
php artisan vendor:publish --provider="Blinqpay\PaymentRouter\PaymentRouterServiceProvider"
```
This will create a config/paymentrouter.php file where you can configure your payment processors.

## Example Configuration
Here’s a sample configuration file (config/paymentrouter.php):

```bash
return [
    'default_processor' => 'paystack',
    'processors' => [
        'paystack' => [
            'name' => 'Paystack',
            'fees' => 2.5,
            'active' => true,
            'supported_currencies' => ['NGN', 'USD', 'EUR', 'GBP'],
        ],
        'flutterwave' => [
            'name' => 'Flutterwave',
            'fees' => 3,
            'active' => true,
            'supported_currencies' => ['NGN', 'USD', 'EUR'],
        ],
    ],
];
```

## Usage
To use the Payment Router in your application, retrieve it from the Laravel service container and call the route method:

```bash
use Blinqpay\PaymentRouter\PaymentRouter;

// Get the PaymentRouter instance
$router = app(PaymentRouter::class);

// Route a payment
$result = $router->route(100, 'NGN', 'Payment for Order #123');

// Output the result
echo $result; // Processed 100 NGN with Paystack. Payment for Order #123
```

The router will automatically select the payment processor with the lowest fees that supports the given currency.

## Available Processors

The package currently supports the following processors:
-PaystackProcessor: A processor with a 2.5% fee and support for multiple currencies.
-FlutterwaveProcessor: A processor with a 3% fee and support for multiple currencies.

## License
This package is open-source software licensed under the [MIT license].
