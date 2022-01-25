<?php

declare(strict_types=1);

namespace DarthSoup\Tests\Whmcs\Auth\Method;

use DarthSoup\Whmcs\Auth\Method\PasswordAuth;
use DarthSoup\WhmcsApi\Client;
use InvalidArgumentException;
use Mockery;
use PHPUnit\Framework\TestCase;

class PasswordAuthTest extends TestCase
{
    protected PasswordAuth $auth;

    protected function setUp(): void
    {
        parent::setUp();

        $this->auth = new PasswordAuth();
    }

    public function testMakeWithMethod()
    {
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('authenticate')
            ->once()->with('identifier', 'secret', Client::AUTH_LOGIN_CREDENTIALS);

        $auth = $this->auth
            ->with($client)
            ->authenticate([
                'username' => 'identifier',
                'password' => 'secret',
            ]);

        $this->assertInstanceOf(Client::class, $auth);
    }

    public function testWithoutUsername()
    {
        $client = Mockery::mock(Client::class);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The password authenticator requires a username.');

        $this->auth->with($client)->authenticate([]);
    }

    public function testWithoutPassword()
    {
        $client = Mockery::mock(Client::class);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The password authenticator requires a password.');

        $this->auth->with($client)->authenticate(['username' => 'foo']);
    }

    public function testMakeWithoutSettingClient()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The client instance was not given to the auth process.');

        $this->auth->authenticate([
            'username' => 'foo',
            'password' => 'bar',
        ]);
    }

}
