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

    'google' => [
       'client_id' => '990917697788-l30e0nu4d7qsae31r7slfn96eq6331tv.apps.googleusercontent.com',
       'client_secret' => 'T17UScKSxswZ2-_5x2nGswCH',
       'redirect' => 'http://www.carmarts.shop/google/callback',
    ],

    'facebook' => [
       'client_id' => '553798405083291',
       'client_secret' => 'e01055f4f77983dde33599a892f840ab',
       'redirect' => 'http://www.carmarts.shop/facebook/callback',
    ],
    'github'=> [
      'client_id' => '04d107a4c88f2a65d55f',
      'client_secret' => '44195c8b49a76b3f946e9f4c781d7f3297a778a5',
      'redirect' => 'http://www.carmarts.shop/github/callback',
   ],
];
