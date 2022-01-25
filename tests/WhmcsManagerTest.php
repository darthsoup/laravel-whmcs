<?php

declare(strict_types=1);

namespace DarthSoup\Tests\Whmcs;

use DarthSoup\Whmcs\WhmcsFactory;
use DarthSoup\Whmcs\WhmcsManager;
use DarthSoup\WhmcsApi\Client;
use Illuminate\Contracts\Config\Repository;
use Mockery;

class WhmcsManagerTest extends AbstractTestCase
{
    public function testCreateConnection()
    {
        $configRepository = Mockery::mock(Repository::class);
        $factory = Mockery::mock(WhmcsFactory::class);
        $manager = new WhmcsManager($configRepository, $factory);

        $config = ['token' => 'your-token'];
        $config['name'] = 'primary';

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('whmcs.connections')->andReturn(['primary' => $config]);
        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Client::class));
        $manager->getConfig()->shouldReceive('get')->once()
            ->with('whmcs.default')->andReturn('primary');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();
        $this->assertInstanceOf(Client::class, $return);
        $this->assertArrayHasKey('primary', $manager->getConnections());
    }
}
