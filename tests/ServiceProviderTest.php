<?php

namespace DarthSoup\Tests\Whmcs;

use DarthSoup\Whmcs\WhmcsManager;

class ServiceProviderTest extends AbstractTestCase
{
    public function testInstantiated()
    {
        $instance = $this->app->make('whmcs');

        $this->assertInstanceOf(WhmcsManager::class, $instance);
    }
}
