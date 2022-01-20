<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs;

use DarthSoup\WhmcsApi\Client;
use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * @method array<string, \DarthSoup\WhmcsApi\Client> getConnections()
 * @method \DarthSoup\WhmcsApi\Api\Authentication authentication()
 * @method \DarthSoup\WhmcsApi\Api\Billing billing()
 * @method \DarthSoup\WhmcsApi\Api\Client client()
 * @method \DarthSoup\WhmcsApi\Api\Custom custom()
 * @method \DarthSoup\WhmcsApi\Api\Domains domains()
 * @method \DarthSoup\WhmcsApi\Api\Orders orders()
 * @method \DarthSoup\WhmcsApi\Api\Servers servers()
 * @method \DarthSoup\WhmcsApi\Api\System system()
 * @method \DarthSoup\WhmcsApi\Api\Users users()
 */
class WhmcsManager extends AbstractManager
{
    protected WhmcsFactory $factory;

    public function __construct(Repository $config, WhmcsFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    protected function createConnection(array $config): Client
    {
        return $this->factory->make($config);
    }

    public function getFactory(): WhmcsFactory
    {
        return $this->factory;
    }

    protected function getConfigName(): string
    {
        return 'whmcs';
    }
}
