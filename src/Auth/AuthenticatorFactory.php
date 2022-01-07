<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs\Auth;

class AuthenticatorFactory
{
    public function make(string $method)
    {

        throw new \InvalidArgumentException("Unsupported authentication method [$method].");
    }
}
