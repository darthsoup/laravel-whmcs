Laravel Whmcs
======

[![Latest Stable Version](https://poser.pugx.org/darthsoup/laravel-whmcs/v/stable)](https://packagist.org/packages/darthsoup/laravel-whmcs)
[![Total Downloads](https://poser.pugx.org/darthsoup/laravel-whmcs/downloads)](https://packagist.org/packages/darthsoup/laravel-whmcs)
[![License](https://poser.pugx.org/darthsoup/laravel-whmcs/license)](https://packagist.org/packages/darthsoup/laravel-whmcs)

A interface for interacting with whmcs api.

## Installation

Install the package through [Composer](http://getcomposer.org/).

Run the Composer require command from the Terminal:

    composer require darthsoup/laravel-whmcs

Run `composer update` to pull in the files.

### After Laravel 5.5

You do not need anything else to do here

### Before Laravel 5.5

Now all you have to do is add the service provider of the package and alias the package. To do this, open your `config/app.php` file.

Add a new line to the `providers` array:

    DarthSoup\Whmcs\WhmcsServiceProvider::class

And optionally add a new line to the `aliases` array:

    'Whmcs' => DarthSoup\Whmcs\Facades\Whmcs::class,

From the command-line run:

    php artisan vendor:publish
    
Then open `config\whmcs.php` to insert your WHMCS api credentials.

Now you're ready to start using the WHMCS API in your application.

## Usage

You can call your WHMCS Instance directly by calling the facade with the an API function.
This also works with custom created API functions which included in your WHMCS API folder.

### Examples

I want all products from an client

```php
\Whmcs::GetClientsProducts([
    'clientid' => '12345'
])
```

I want a invoice from a customer

```php
\Whmcs::GetInvoice([
    'invoiceid' => '1337'
])
```

## Support

[Please open an issue in github](https://github.com/darthsoup/laravel-whmcs/issues)

## License

This package is released under the MIT License. See the bundled
[LICENSE](https://github.com/darthsoup/laravel-whmcs/blob/master/LICENSE) file for details.
