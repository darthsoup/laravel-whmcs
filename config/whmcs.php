<?php

return [

    /*
    |--------------------------------------------------------------------------
    | HTTP Driver
    |--------------------------------------------------------------------------
    |
    | Supported: "guzzlehttp"
    */

    'driver' => 'guzzlehttp',

    /*
    |--------------------------------------------------------------------------
    | API Credentials
    |--------------------------------------------------------------------------
    |
    | Enter the unhashed variant of your password if you use 'password' as 'auth_type'
    |
    | Supported auth types': "api", "password"
    |
    */

    'auth_type' =>  env('WHMCS_AUTH_TYPE', 'password'),

    'apiurl' => env('WHMCS_API_URL', 'https://url.to.whmcs.tld/whmcs/includes/api.php'),

    'api' => [
        'identifier' => env('WHMCS_API_IDENTIFIER', 'YOUR_API_IDENTIFIER'),
        'secret' => env('WHMCS_API_SECRET', 'YOUR_API_SECRET'),
    ],

    'password' => [
        'username' => env('WHMCS_USERNAME', 'YOUR_USERNAME'),
        'password' => env('WHMCS_PASSWORD', 'YOUR_PASSWORD'),
    ],

    /*
    |--------------------------------------------------------------------------
    | ResponseType
    |--------------------------------------------------------------------------
    |
    | Supported auth types': "json", "xml"
    |
    */

    'responsetype' => env('WHMCS_RESPONSE_TYPE', 'json'),
];
