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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [ 
        'client_id' => '747109196706376',
        'client_secret' => '801a289b2e9bfb077b86cbbd97852c62',
        'redirect' => 'http://localhost:8000/facebook-login-system',
     ],
    'github' => [ 
        'client_id' => 'ccc527fc8249275e16e1',
        'client_secret' => '1f85a40824238ba10729092eb4f9acc77add0ae6',
        'redirect' => 'http://localhost:8000/github-login-system',
     ],
     

];
