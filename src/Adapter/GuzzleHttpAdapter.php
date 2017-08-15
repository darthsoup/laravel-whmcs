<?php

namespace DarthSoup\Whmcs\Adapter;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Arr;
use InvalidArgumentException;

/**
 * Class GuzzleHttpAdapter
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
        $config = $this->getConfig($config);

        return $this->getAdapter($config);
    }

    /**
     * @param $config
     * @return array|null
     * @throws \InvalidArgumentException
     */
    private function getConfig($config)
    {
        if ('password' === $config['auth_type']) {
            if (!array_key_exists('username', $config) || empty($config['username'])) {
                throw new InvalidArgumentException('The guzzlehttp connector requires configuration.');
            }

            if (!array_key_exists('password', $config) || empty($config['password'])) {
                throw new InvalidArgumentException('The guzzlehttp connector requires configuration.');
            }

            $config['password'] = md5($config['password']);

            return $config;
        }
    }

    /**
     * @param array $config
     * @return Client
     */
    private function getAdapter(array $config)
    {
        return new Client([
            'base_uri' => $config['apiurl'],
            'timeout' => 30,
            'form_params' => [
                'username' => $config['username'],
                'password' => $config['password'],
                'responsetype' => Arr::get($config, 'responsetype', 'json')
            ],
            'headers' => [
                'User-Agent' => 'Laravel WHMCS API Interface',
            ]
        ]);
    }
}
