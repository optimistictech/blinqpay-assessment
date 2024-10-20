<?php

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
