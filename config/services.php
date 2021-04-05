<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => '1058142681369-uevhgolcqq87799ul5kbmu9lbe9h6vo1.apps.googleusercontent.com',
        'client_secret' => 'WRaG_tYF9ODYeuWBI9h9B71D',
        'redirect' => '/auth/google/callback',
    ],
    'facebook' => [
        'client_id' => '3919353614769746',
        'client_secret' => '35d97c98fd2ffa059f1dc1ccafa8ab6c',
        'redirect' => '/auth/facebook/callback',
    ],

];

