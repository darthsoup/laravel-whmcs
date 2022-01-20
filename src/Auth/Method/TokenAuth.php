<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs\Auth\Method;

use DarthSoup\Whmcs\Auth\AbstractAuth;
use DarthSoup\WhmcsApi\Client;
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
            $config['identifer'],
            $config['secret'],
            Client::AUTH_API_CREDENTIALS
        );

        return $this->client;
    }
}
