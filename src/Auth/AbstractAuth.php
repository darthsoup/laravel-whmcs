<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs\Auth;

use DarthSoup\WhmcsApi\Client;

abstract class AbstractAuth implements AuthInterface
{
    protected ?Client $client;

    public function with(Client $client): AuthInterface
    {
        $this->client = $client;

        return $this;
    }
}
