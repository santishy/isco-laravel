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
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'paypal' => [
        'clientid' => env('PAYPAL_CLIENT_ID','AUosvEzvStLLnWkFQgb3Qp27r9aboDkJiFCbTa-YVah_CMfZvgzZLcmmt_0qurVYx0yj4UDlh7G1HHa-'),
        'secret' => env('PAYPAL_CLIENT_SECRET','EPz3MBShrrVC74X55JDid6-6lgdaIBrSi3Z_i7q4oG2pnzvnGppTvHLNxtf3cyMUTGa-We2mZTlUwGJB')
    ],
    'mercadopago' =>[
      'base_uri' => env('MERCADO_PAGO_BASE_URI'),
      'key' => env('MERCADO_PAGO_KEY'),
      'secret' => env('MERCADO_PAGO_SECRET'),
      'class' => App\MercadoPagoService::class,
      'base_currency' => 'mxn'
    ],

];
