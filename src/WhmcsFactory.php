<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs;

use DarthSoup\Whmcs\Auth\AuthFactory;
use DarthSoup\WhmcsApi\Client;
use DarthSoup\WhmcsApi\HttpClient\Builder;
use Http\Client\Common\Plugin\RetryPlugin;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class WhmcsFactory
{
    protected AuthFactory $auth;

    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

    public function make(array $config): Client
    {
        $client = $this->getClient($this->getBuilder($config));

        if (!array_key_exists('method', $config)) {
            throw new InvalidArgumentException('The whmcs factory requires an auth method.');
        }

        if ($url = Arr::get($config, 'url')) {
            $client->url($url);
        }

        if ($config['method'] === 'none') {
            return $client;
        }

        return $this->auth->make($config['method'])->with($client)->authenticate($config);
    }

    protected function getBuilder(array $config): Builder
    {
        $builder = new Builder();

        if ($backoff = Arr::get($config, 'backoff')) {
            $builder->addPlugin(
                new RetryPlugin(['retries' => $backoff === true ? 2 : $backoff])
            );
        }

        return $builder;
    }

    protected function getClient(Builder $builder): Client
    {
        return new Client($builder);
    }
}
