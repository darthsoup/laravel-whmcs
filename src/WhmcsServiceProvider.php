<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs;

use DarthSoup\Whmcs\Adapter\GuzzleHttpAdapter;
use Illuminate\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class WhmcsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath($raw = __DIR__ . '/../config/whmcs.php') ?: $raw;

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('whmcs.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('whmcs');
        }

        $this->mergeConfigFrom($source, 'whmcs');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerClient();

        $this->registerManager();
    }

    /**
     * Register HttpClient.
     */
    public function registerClient()
    {
        $this->app->singleton('whmcs.client', function () {
            return new GuzzleHttpAdapter();
        });

        $this->app->alias('whmcs.client', GuzzleHttpAdapter::class);
    }

    /**
     * Register Manager.
     */
    public function registerManager()
    {
        $this->app->singleton('whmcs', function (Container $app) {
            $config = $app['config'];
            $client = $app['whmcs.client'];

            return new WhmcsManager($config, $client);
        });

        $this->app->alias('whmcs', WhmcsManager::class);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            'whmcs.client',
            'whmcs',
        ];
    }
}
