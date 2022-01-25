<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs\Auth\Method;

use DarthSoup\Whmcs\Auth\AbstractAuth;
use DarthSoup\WhmcsApi\Client;
use InvalidArgumentException;

class PasswordAuth extends AbstractAuth
{
    public function authenticate(array $config): Client
    {
        if (!$this->client) {
            throw new InvalidArgumentException('The client instance was not given to the auth process.');
        }

        if (!array_key_exists('username', $config)) {
            throw new InvalidArgumentException('The password authenticator requires a username.');
        }
        if (!array_key_exists('password', $config)) {
            throw new InvalidArgumentException('The password authenticator requires a password.');
        }

        $this->client->authenticate(
            $config['username'],
            $config['password'],
            Client::AUTH_LOGIN_CREDENTIALS
        );

        return $this->client;
    }
}
