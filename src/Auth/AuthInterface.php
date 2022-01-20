<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs\Auth;

use DarthSoup\WhmcsApi\Client;

interface AuthInterface
{
    public function with(Client $client): AuthInterface;

    public function authenticate(array $config): Client;
}
