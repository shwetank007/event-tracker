<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

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
        'client_id'     => '1805231476358990',
        'client_secret' => '3c942edf510969ae8de8102b35527f46',
        'redirect'      => 'http://localhost/Event_Manager/public/callback/facebook',
    ],

    'twitter' => [
        'client_id'     => 'YA4j0BbkCQzJaVwnvjxMcQx7c',
        'client_secret' => 'ipm9aUXeHHDN9zJQRsNVjHhR4iThrCzb7YbCveN3BLJeDB5Mf1',
        'redirect'      => 'http://localhost/Event_Manager/public/callback/twitter',
    ],

    'linkedin' => [
        'client_id'     => '81mir333w3kz85',
        'client_secret' => 'f4m0XMFdgWh72FOJ',
        'redirect'      => 'http://localhost/Event_Manager/public/callback/linkedin',
    ],

    'google' => [
        'client_id'     => '734409319232-nk38vb04pv2bksh0452lg2ecjoodolb6.apps.googleusercontent.com',
        'client_secret' => 'QFd2Od1GiuEiJQwgTIyi5oHD',
        'redirect'      => 'http://localhost/Event_Manager/public/callback/google',
    ],

];
