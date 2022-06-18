<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection
    |--------------------------------------------------------------------------
    |
    | Define your default whmcs connection below. You may use as many
    | connections as you need with the manager class.
    |
    */

    'default' => 'primary',

    /*
    |--------------------------------------------------------------------------
    | WHMCS Connections
    |--------------------------------------------------------------------------
    |
    | Define your whmcs connections here.
    | Do not add the path `/includes/api.php` to the URL, it will be added
    | automatically.
    |
    | Note that WHMCS only support these two authentication methods.
    | Methods: "password", "token"
    |
    */

    'connections' => [

        'primary' => [
            'method' => env('WHMCS_AUTH_TYPE', 'password'),
            'url' => env('WHMCS_API_URL', 'https://url.to.whmcs.tld/path_to_whmcs'),
            'username' => env('WHMCS_USERNAME', 'YOUR_USERNAME'),
            'password' => env('WHMCS_PASSWORD', 'YOUR_PASSWORD'),
            'access_key' => env('WHMCS_ACCESSKEY')
        ],

        'secondary' => [
            'method' => env('WHMCS_AUTH_TYPE', 'token'),
            'url' => env('WHMCS_API_URL', 'https://url.to.whmcs.tld/path_to_whmcs'),
            'identifier' => env('WHMCS_API_IDENTIFIER', 'YOUR_API_IDENTIFIER'),
            'secret' => env('WHMCS_API_SECRET', 'YOUR_API_SECRET'),
            'access_key' => env('WHMCS_API_ACCESSKEY')
        ],

    ]
];
