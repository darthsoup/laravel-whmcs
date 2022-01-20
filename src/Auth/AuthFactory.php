<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs\Auth;

use InvalidArgumentException;

class AuthFactory
{
    public function make(string $method): AuthInterface
    {
        switch ($method) {
            case 'password':
                return new Method\PasswordAuth();
            case 'token':
                return new Method\TokenAuth();
        }

        throw new InvalidArgumentException("Unsupported authentication method [$method].");
    }
}
