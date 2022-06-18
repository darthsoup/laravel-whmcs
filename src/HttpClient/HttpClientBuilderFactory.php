<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs\HttpClient;

use DarthSoup\WhmcsApi\HttpClient\Builder;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

class HttpClientBuilderFactory
{
    protected ClientInterface $httpClient;

    protected RequestFactoryInterface $requestFactory;

    protected StreamFactoryInterface $streamFactory;

    protected UriFactoryInterface $uriFactory;

    /**
     * @param ClientInterface $httpClient
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface $streamFactory
     * @param UriFactoryInterface $uriFactory
     */
    public function __construct(
        ClientInterface         $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface  $streamFactory,
        UriFactoryInterface     $uriFactory
    )
    {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->uriFactory = $uriFactory;
    }

    public function make(): Builder
    {
        return new Builder($this->httpClient, $this->requestFactory, $this->streamFactory, $this->uriFactory);
    }
}
