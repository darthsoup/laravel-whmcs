<?php

declare(strict_types=1);

namespace DarthSoup\Tests\Whmcs\Auth;

use DarthSoup\Whmcs\Auth\AuthFactory;
use DarthSoup\Whmcs\Auth\Method\PasswordAuth;
use DarthSoup\Whmcs\Auth\Method\TokenAuth;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AuthFactoryTest extends TestCase
{
    protected AuthFactory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = new AuthFactory();
    }

    public function testMakePasswordAuth()
    {
        $method = $this->factory->make('password');

        $this->assertInstanceOf(PasswordAuth::class, $method);
    }

    public function testMakeTokenAuth()
    {
        $method = $this->factory->make('token');

        $this->assertInstanceOf(TokenAuth::class, $method);
    }

    public function testMakeInvalidAuth()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported authentication method [fail].');

        $this->factory->make('fail');
    }
}
