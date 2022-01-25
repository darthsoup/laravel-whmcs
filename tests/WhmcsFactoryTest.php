<?php

declare(strict_types=1);

namespace DarthSoup\Tests\Whmcs;

use DarthSoup\Whmcs\Auth\AuthFactory;
use DarthSoup\Whmcs\WhmcsFactory;
use DarthSoup\WhmcsApi\Client;
use Http\Client\Common\HttpMethodsClientInterface;
use InvalidArgumentException;

class WhmcsFactoryTest extends AbstractTestCase
{
    protected WhmcsFactory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = new WhmcsFactory(new AuthFactory());
    }

    public function testMakeConnectionWithMethod()
    {
        $client = $this->factory->make([
            'method' => 'token',
            'identifier' => 'foo',
            'secret' => 'bar',
            'url' => 'https://whmcs.example.com/includes/api.php'
        ]);

        $this->assertInstanceOf(Client::class, $client);
        $this->assertInstanceOf(HttpMethodsClientInterface::class, $client->getHttpClient());
    }

    public function testWithoutMethod()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The whmcs factory requires an auth method');

        $this->factory->make([]);
    }
}
