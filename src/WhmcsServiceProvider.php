<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs;

use DarthSoup\Whmcs\Auth\AuthFactory;
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
        $this->registerAuthFactory();
        $this->registerWhmcsFactroy();
        $this->registerManager();
    }

    /**
     * Register the auth factory class.
     */
    protected function registerAuthFactory(): void
    {
        $this->app->singleton('whmcs.authfactory', function () {
            return new AuthFactory();
        });

        $this->app->alias('whmcs.authfactory', AuthFactory::class);
    }

    /**
     * Register the whmcs factory class.
     */
    public function registerWhmcsFactroy(): void
    {
        $this->app->singleton('whmcs.factory', function (Container $app) {
            $auth = $app['whmcs.authfactory'];

            return new WhmcsFactory($auth);
        });

        $this->app->alias('whmcs.factory', WhmcsFactory::class);
    }

    /**
     * Register the whmcs factory class.
     */
    public function registerManager(): void
    {
        $this->app->singleton('whmcs', function (Container $app) {
            $config = $app['config'];
            $factory = $app['whmcs.factory'];

            return new WhmcsManager($config, $factory);
        });

        $this->app->alias('whmcs', WhmcsManager::class);
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return [
            'whmcs.authfactory',
            'whmcs.factory',
            'whmcs',
        ];
    }
}
