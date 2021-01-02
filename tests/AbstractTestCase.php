<?php

namespace DarthSoup\Tests\Whmcs;

use DarthSoup\Whmcs\Facades\Whmcs;
use DarthSoup\Whmcs\WhmcsServiceProvider;
use Orchestra\Testbench\TestCase;

abstract class AbstractTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [WhmcsServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return ['Whmcs' => Whmcs::class];
    }
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('session.driver', 'array');
    }
}
