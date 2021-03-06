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

    'google' => [
        'client_id' => '758818420378-kcg3p2or8bm0faha8vubpp4b7vsipsv0.apps.googleusercontent.com',
        'client_secret' => 'ymzSbZHLKm6awCRsuiKyVTZQ',
        'redirect' => '',
    ],

    'facebook' => [
        'client_id' => '223852384693149',
        'client_secret' => 'b0b7723c1d20ab41846ab00f376f3232',
        'redirect' => '',
    ],    

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],



];
