<?php

namespace DarthSoup\Tests\Whmcs;

use Whmcs;

class ServiceProviderTest extends TestCase
{
    /** @test */
    public function ThrowAnExceptionIfConfigNotExist()
    {
        $this->app['config']->set('whmcs.password.username', '');
        $this->app['config']->set('whmcs.password.password', '');

        $this->expectException(\InvalidArgumentException::class);

        // call random WHMCS API
        Whmcs::GetProducts();
    }

    /** @test */
    public function CanGetWhmcsProduct()
    {
        // call random WHMCS API
        $result = Whmcs::GetProducts();
        $this->assertNotNull($result);
    }
}
