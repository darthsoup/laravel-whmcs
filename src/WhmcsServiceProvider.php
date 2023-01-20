<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs;

use DarthSoup\Whmcs\Auth\AuthFactory;
use DarthSoup\Whmcs\HttpClient\HttpClientBuilderFactory;
use DarthSoup\WhmcsApi\Client;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\HttpFactory as PsrHttpFactory;
use Illuminate\Container\Container;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

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

        if ($this->app instanceof Application && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('whmcs.php')]);
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
        $this->registerHttpClientFactory();
        $this->registerAuthFactory();
        $this->registerWhmcsFactroy();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the http client factory class.
     */
    protected function registerHttpClientFactory(): void
    {
        $this->app->singleton('whmcs.httpclientfactory', function (Container $app) {
            $psrFactory = new PsrHttpFactory();

            return new HttpClientBuilderFactory(
                new GuzzleClient([
                    'connect_timeout' => $app['config']->get('whmcs.connect_timeout', 10),
                    'timeout' => $app['config']->get('whmcs.timeout', 30),
                ]),
                $psrFactory,
                $psrFactory,
                $psrFactory,
            );
        });

        $this->app->alias('whmcs.httpclientfactory', HttpClientBuilderFactory::class);
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
            $builder = $app['whmcs.httpclientfactory'];
            $auth = $app['whmcs.authfactory'];

            return new WhmcsFactory($auth, $builder);
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
     * Register the bindings.
     */
    protected function registerBindings(): void
    {
        $this->app->bind('whmcs.connection', function (Container $app) {
            /** @var WhmcsManager $manager */
            $manager = $app['whmcs'];

            return $manager->connection();
        });

        $this->app->alias('whmcs.connection', Client::class);
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return [
            'whmcs.httpclientfactory',
            'whmcs.authfactory',
            'whmcs.factory',
            'whmcs',
            'whmcs.connection',
        ];
    }
}
