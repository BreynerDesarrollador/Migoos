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
    'facebook' => [
        'client_id' => '1812889292256171',
        'client_secret' => 'b9b1b82396af0f7b6b6cd743e085825f',
        'redirect' => 'http://localhost:8000/auth/facebook/callback'
    ],
    'google' => [
        //Id suministrado por google
        'client_id'     => '504744434203-26pbj9oojmjjkbpidmsf81rtjulceplp.apps.googleusercontent.com',
        //Secret suministrado por google
        'client_secret' => 'MbSmczYAbl9H8hf-pTQC8ZGm',
        //Página a la que sera redireccionado el navegador cuando el login se exitoso
        //Ejemplo: http://midominio.com/social/handle/google
        'redirect'      => 'http://localhost:8000/auth/google/callback'
    ]

];
