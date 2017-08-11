Laravel Whmcs
======

A interface for interacting with whmcs api.

## Installation

Install the package through [Composer](http://getcomposer.org/). 

Run the Composer require command from the Terminal:

    composer require darthsoup/laravel-whmcs

Run `composer update` to pull in the files.

Now all you have to do is add the service provider of the package and alias the package. To do this, open your `config/app.php` file.

Add a new line to the `providers` array:

    DarthSoup\Whmcs\WhmcsServiceProvider::class

And optionally add a new line to the `aliases` array:

    'Whmcs' => DarthSoup\Whmcs\Facades\Whmcs::class,

From the command-line run:

    `php artisan vendor:publish`
    
Then open `config\whmcs.php` to insert you WHMCS api credentials.

Now you're ready to start using the WHMCS API in your application.

## Usage
TODO

Example:
```php
\Whmcs::GetClientsProducts([
    'clientid' => '12345'
])
```

## Support

[Please open an issue in github](https://github.com/darthsoup/laravel-whmcs/issues)

## License

This package is released under the MIT License. See the bundled
[LICENSE](https://github.com/darthsoup/laravel-whmcs/blob/master/README.md) file for details.


