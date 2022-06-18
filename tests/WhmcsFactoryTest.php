<?php

declare(strict_types=1);

namespace DarthSoup\Tests\Whmcs;

use DarthSoup\Whmcs\Auth\AuthFactory;
use DarthSoup\Whmcs\HttpClient\HttpClientBuilderFactory;
use DarthSoup\Whmcs\WhmcsFactory;
use DarthSoup\WhmcsApi\Client;
use GuzzleHttp\Client as GuzzleClient;
use Http\Client\Common\HttpMethodsClientInterface;
use InvalidArgumentException;
use GuzzleHttp\Psr7\HttpFactory as PsrHttpFactory;

class WhmcsFactoryTest extends AbstractTestCase
{
    protected WhmcsFactory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $psrFactory = new PsrHttpFactory();

        $builder = new HttpClientBuilderFactory(
            new GuzzleClient(['connect_timeout' => 10, 'timeout' => 30]),
            $psrFactory,
            $psrFactory,
            $psrFactory,
        );

        $this->factory = new WhmcsFactory(
            new AuthFactory(),
            $builder,
        );
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

    public function testInvalidMethod()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported authentication method');

        $this->factory->make(['method' => 'foo']);
    }
}
