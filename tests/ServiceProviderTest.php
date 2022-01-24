<?php

namespace DarthSoup\Tests\Whmcs;

use DarthSoup\Whmcs\Auth\AuthFactory;
use DarthSoup\Whmcs\WhmcsFactory;
use DarthSoup\Whmcs\WhmcsManager;

class ServiceProviderTest extends AbstractTestCase
{
    public function testAuthFactory()
    {
        $instance = $this->app->make('whmcs.authfactory');

        $this->assertInstanceOf(AuthFactory::class, $instance);
    }

    public function testWhmcsFactory()
    {
        $instance = $this->app->make('whmcs.factory');

        $this->assertInstanceOf(WhmcsFactory::class, $instance);
    }

    public function testManager()
    {
        $instance = $this->app->make('whmcs');

        $this->assertInstanceOf(WhmcsManager::class, $instance);
    }
}
