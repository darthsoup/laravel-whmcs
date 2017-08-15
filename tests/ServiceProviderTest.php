<?php

namespace DarthSoup\Tests\Whmcs;

use Whmcs;

class ServiceProviderTest extends TestCase
{
    /** @test */
    public function ThrowAnExceptionIfConfigNotExist()
    {
        $this->app['config']->set('whmcs.username', '');
        $this->app['config']->set('whmcs.password', '');

        $this->expectException(\InvalidArgumentException::class);

        // call random WHMCS API
        Whmcs::GetProducts();
    }
}
