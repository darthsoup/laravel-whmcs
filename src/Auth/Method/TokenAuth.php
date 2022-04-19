<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs\Auth\Method;

use DarthSoup\Whmcs\Auth\AbstractAuth;
use DarthSoup\WhmcsApi\Client;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class TokenAuth extends AbstractAuth
{
    public function authenticate(array $config): Client
    {
        if (!$this->client) {
            throw new InvalidArgumentException('The client instance was not given to the auth process.');
        }

        if (!array_key_exists('identifier', $config)) {
            throw new InvalidArgumentException('The token authenticator requires a identifier.');
        }
        if (!array_key_exists('secret', $config)) {
            throw new InvalidArgumentException('The token authenticator requires a secret.');
        }

        $this->client->authenticate(
            $config['identifier'],
            $config['secret'],
            Client::AUTH_API_CREDENTIALS
        );

        if (Arr::has($config, 'access_key') && null !== $config['access_key']) {
            $this->client->accessKey($config['access_key']);
        }

        return $this->client;
    }
}
