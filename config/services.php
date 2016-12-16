<?php

return [



    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '159258601213897',
        'client_secret' => '901829799d2f9193aeb2e7c76495721e',
        'scope' => 'email',
        'redirect' => 'http://joni.am/callback/facebook',
    ],

    'google' => [
        'client_id' => '406245369148-nfoh32gns8sa716oa6ns7pufmohsqm8g.apps.googleusercontent.com',
        'client_secret' => 'psQoJRLDhdtQIusXKMY8o2Gt',
        'redirect' => 'http://joni.am/callback/google',
    ],
];
