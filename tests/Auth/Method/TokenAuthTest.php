<?php

declare(strict_types=1);

namespace DarthSoup\Tests\Whmcs\Auth\Method;

use DarthSoup\Whmcs\Auth\Method\TokenAuth;
use DarthSoup\WhmcsApi\Client;
use InvalidArgumentException;
use Mockery;
use PHPUnit\Framework\TestCase;

class TokenAuthTest extends TestCase
{
    protected TokenAuth $auth;

    protected function setUp(): void
    {
        parent::setUp();

        $this->auth = new TokenAuth();
    }

    public function testMakeWithMethod()
    {
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('authenticate')
            ->once()->with('identifier', 'secret', Client::AUTH_API_CREDENTIALS);

        $auth = $this->auth
            ->with($client)
            ->authenticate([
                'identifier' => 'identifier',
                'secret' => 'secret',
            ]);

        $this->assertInstanceOf(Client::class, $auth);
    }

    public function testWithoutUsername()
    {
        $client = Mockery::mock(Client::class);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The token authenticator requires a identifier.');

        $this->auth->with($client)->authenticate([]);
    }

    public function testWithoutPassword()
    {
        $client = Mockery::mock(Client::class);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The token authenticator requires a secret.');

        $this->auth->with($client)->authenticate(['identifier' => 'foo']);
    }

    public function testMakeWithoutSettingClient()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The client instance was not given to the auth process.');

        $this->auth->authenticate([
            'identifier' => 'foo',
            'secret' => 'bar',
        ]);
    }

}
