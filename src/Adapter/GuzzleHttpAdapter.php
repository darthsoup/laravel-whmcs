<?php

namespace DarthSoup\Whmcs\Adapter;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use InvalidArgumentException;
use GuzzleHttp\ClientInterface;

/**
 * Class GuzzleHttpAdapter.
 */
class GuzzleHttpAdapter implements ConnectorInterface
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var array
     */
    protected $config;

    /**
     * @param array $config
     * @return mixed
     */
    public function connect(array $config)
    {
        $this->config = $this->getConfig($config);

        return $this->getAdapter();
    }

    /**
     * @param $config
     * @return array|null
     * @throws \InvalidArgumentException
     */
    private function getConfig($config)
    {
        if ('api' === $config['auth_type']) {
            $credentials = Arr::get($config, $config['auth_type']);

            if (! array_key_exists('identifier', $credentials) || empty($credentials['identifier'])) {
                throw new InvalidArgumentException('The guzzlehttp connector requires configuration.');
            }

            if (! array_key_exists('secret', $credentials) || empty($credentials['secret'])) {
                throw new InvalidArgumentException('The guzzlehttp connector requires configuration.');
            }

            return $config;
        }

        if ('password' === $config['auth_type']) {
            $credentials = Arr::get($config, $config['auth_type']);

            if (! array_key_exists('username', $credentials) || empty($credentials['username'])) {
                throw new InvalidArgumentException('The guzzlehttp connector requires configuration.');
            }

            if (! array_key_exists('password', $credentials) || empty($credentials['password'])) {
                throw new InvalidArgumentException('The guzzlehttp connector requires configuration.');
            }

            $credentials['password'] = md5($credentials['password']);
            Arr::set($config, $config['auth_type'], $credentials);

            return $config;
        }

        throw new InvalidArgumentException('Unsupported whmcs auth type');
    }

    /**
     * @return Client
     */
    private function getAdapter()
    {
        return new Client([
            'timeout' => 30,
            'form_params' => array_merge(
                Arr::get($this->config, $this->config['auth_type']),
                [
                    'responsetype' => Arr::get($this->config, 'responsetype', 'json'),
                ]
            ),
            'headers' => [
                'User-Agent' => 'Laravel WHMCS API Interface',
            ],
        ]);
    }
}
