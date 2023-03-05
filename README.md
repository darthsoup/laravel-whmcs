WHMCS API for Laravel
======

[![Latest Stable Version](https://poser.pugx.org/darthsoup/laravel-whmcs/v/stable)](https://packagist.org/packages/darthsoup/laravel-whmcs)
[![Total Downloads](https://poser.pugx.org/darthsoup/laravel-whmcs/downloads)](https://packagist.org/packages/darthsoup/laravel-whmcs)
[![License](https://poser.pugx.org/darthsoup/laravel-whmcs/license)](https://packagist.org/packages/darthsoup/laravel-whmcs)

An interface for interaction with the WHMCS API in Laravel.
This Package is heavily inspired by [Laravel GitLab](https://github.com/GrahamCampbell/Laravel-GitLab) created
by [Graham Campbell](https://github.com/GrahamCampbell/).

> **Notice:**
>
> The legacy version 0.3 can be found [here](https://github.com/darthsoup/laravel-whmcs/tree/legacy)

## Installation

WHMCS API for Laravel requires PHP ^7.4 | ^8.0 with at least Laravel 8.

Install the package through [Composer](http://getcomposer.org/). Run the Composer require command from the Terminal:

```bash
composer require darthsoup/laravel-whmcs
```

Package will be installed automatically through composer package discovery. If not, then you need to register
the `DarthSoup\Whmcs\WhmcsService` service provider in your `config/app.php`.

Optionally, you can add the alias if you prefer to use the Facade:

```php
'Whmcs' => DarthSoup\Whmcs\Facades\Whmcs::class
```

## Configuration

To get started, you'll need to publish vendor assets for Laravel-Whmcs.

```bash
php artisan vendor:publish --provider="DarthSoup\Whmcs\WhmcsServiceProvider"
```

This will create the `config/whmcs.php` file in your app, modify it to set your configuration.

#### Default Connection

The option `default` is where you specify the default connection.

#### WHMCS Connections

The option `connections` is where you can add multiple connections to your whmcs instances.
You can choose between both API connection types from whmcs. These methods are `password` and `token`.
Example connections has been included, but you can add as many connections you would like.

## Usage

#### via dependency injection

If you prefer to use Dependency Injection, you can easily add it to your controller as below:

```php
use DarthSoup\Whmcs\WhmcsManager;

class WhmcsController extends Controller
{
    private WhmcsManager $whmcsManager;

    public function __construct(WhmcsManager $whmcsManager)
    {
        $this->whmcsManager = $whmcsManager;
    }

    public function index()
    {
        $result = $this->whmcsManager->client()->getClients();
        dd($result);
    }
}
```

#### Via Facade

If you prefer the classic Laravel facade style, this might be the way to go:

```php
use \DarthSoup\Whmcs\Facades\Whmcs;
# or
use \Whmcs;

\Whmcs::Client()->getClientsDomains(['clientid' => '1']);
```

#### Real examples 

```php
use \DarthSoup\Whmcs\Facades\Whmcs;

# Obtaining a list of domains purchased by the customer
\Whmcs::Client()->getClientsDomains(['clientid' => '1']);

# Obtaining a list of products purchased by the customer
\Whmcs::Client()->getClientsProducts(['clientid' => '12345']);

# Retrieve a specific invoice
\Whmcs::Billing()->getInvoice(['invoiceid' => '1337']);

# Retrieves all Orders from the system
\Whmcs::Orders()->getOrders();

# Obtain internal users
\Whmcs::Users()->getUsers(['search' => 'foo@bar.org']);

# Custom Method (in case you added custom endpoints) 
\Whmcs::Custom()-><myEndpoint>(['foo' => 'bar']);
```

For more information on how to use the WhmcsApi Client `DarthSoup\WhmcsApi\Client` class, check out the documentation
at https://github.com/darthsoup/php-whmcs-api.

## Support

[Please open an issue in github](https://github.com/darthsoup/laravel-whmcs/issues)

## License

This package is released under the MIT License. See the bundled
[LICENSE](https://github.com/darthsoup/laravel-whmcs/blob/master/LICENSE.md) file for details.
