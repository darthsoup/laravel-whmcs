<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection
    |--------------------------------------------------------------------------
    |
    | Define your default whmcs connection
    |
    */

    'default' => 'primary',

    /*
    |--------------------------------------------------------------------------
    | WHMCS Connections
    |--------------------------------------------------------------------------
    |
    | Define your whmcs connections here.
    | Do not add the path `/includes/api.php` to the URL, it will be added automatically.
    |
    | Methods: "password", "token"
    |
    */

    'connections' => [

        'primary' => [
            'method' => env('WHMCS_AUTH_TYPE', 'password'),
            'url' => env('WHMCS_API_URL', 'https://url.to.whmcs.tld/whmcs'),
            'username' => env('WHMCS_USERNAME', 'YOUR_USERNAME'),
            'password' => env('WHMCS_PASSWORD', 'YOUR_PASSWORD'),
            'access_key' => env('WHMCS_ACCESSKEY')
        ],

        'secondary' => [
            'method' => env('WHMCS_AUTH_TYPE', 'token'),
            'url' => env('WHMCS_API_URL', 'https://url.to.whmcs.tld/whmcs'),
            'identifier' => env('WHMCS_API_IDENTIFIER', 'YOUR_API_IDENTIFIER'),
            'secret' => env('WHMCS_API_SECRET', 'YOUR_API_SECRET'),
            'access_key' => env('WHMCS_API_ACCESSKEY')
        ]
    ]
];
