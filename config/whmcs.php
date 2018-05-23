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

    'auth_type' => 'password',

    'apiurl' => 'https://url.to.whmcs.tld/whmcs/includes/api.php',

    'api' => [
        'identifier' => 'YOUR_API_IDENTIFIER',
        'secret' => 'YOUR_API_SECRET'
    ],

    'password' => [
        'username' => 'YOUR_USERNAME',
        'password' => 'YOUR_PASSWORD',
    ],

    /*
    |--------------------------------------------------------------------------
    | ResponseType
    |--------------------------------------------------------------------------
    |
    | Supported auth types': "json", "xml"
    |
    */

    'responsetype' => 'json'
];
