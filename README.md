Laravel WHMCS
======

[![Latest Stable Version](https://poser.pugx.org/darthsoup/laravel-whmcs/v/stable)](https://packagist.org/packages/darthsoup/laravel-whmcs)
[![Total Downloads](https://poser.pugx.org/darthsoup/laravel-whmcs/downloads)](https://packagist.org/packages/darthsoup/laravel-whmcs)
[![License](https://poser.pugx.org/darthsoup/laravel-whmcs/license)](https://packagist.org/packages/darthsoup/laravel-whmcs)

An interface for interaction with the WHMCS API in Laravel.

## Installation

Install the package through [Composer](http://getcomposer.org/).

Run the Composer require command from the Terminal:

```bash
composer require darthsoup/laravel-whmcs
```

Run `composer update` to pull in the files.

### After Laravel 5.5

You don't have to do anything else here.

### Before Laravel 5.5

Now all you have to do is add the service provider of the package and alias the package. To do this, open your `config/app.php` file.

Add a new line to the `providers` array:

```php
DarthSoup\Whmcs\WhmcsServiceProvider::class
```

And optionally add a new line to the `aliases` array:

```php
'Whmcs' => DarthSoup\Whmcs\Facades\Whmcs::class,
```

From the command-line run:

```bash
php artisan vendor:publish --provider=DarthSoup\Whmcs\WhmcsServiceProvider
```

Then open `config\whmcs.php` to insert your WHMCS api credentials.

Now you can use the WHMCS API in your Laravel project.

### Lumen

Copy the config file from the package to in your config directory:

```bash
cp vendor/darthsoup/laravel-whmcs/config/whmcs.php config/whmcs.php
```

Then open `config\whmcs.php` to insert your WHMCS api credentials.

To finish this, register the config file and the service provider in `bootstrap/app.php`:

```php
$app->configure('whmcs');
$app->register(DarthSoup\Whmcs\WhmcsServiceProvider::class);
```

Now you can use the WHMCS API in your Lumen project.

## Usage

You can call your WHMCS API directly by calling the `\WHMCS::{WHMCSAPIFUNCTION}` facade.
This also works with custom API functions contained in your WHMCS API folder.

### Examples

Obtain a list of client purchased products

```php
\Whmcs::GetClientsProducts([
    'clientid' => '12345'
])
```

Retrieve a specific invoice

```php
\Whmcs::GetInvoice([
    'invoiceid' => '1337'
])
```

If you dont use the Facade, you can call it with the `app()` helper.

```php
$whmcs = app('whmcs');
$whmcs->execute('GetInvoice', [
    'invoiceid' => '1337'
]);
```

## Support

[Please open an issue in github](https://github.com/darthsoup/laravel-whmcs/issues)

## License

This package is released under the MIT License. See the bundled
[LICENSE](https://github.com/darthsoup/laravel-whmcs/blob/master/LICENSE) file for details.
