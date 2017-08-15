<?php

namespace DarthSoup\Tests\Whmcs;

use DarthSoup\Whmcs\Facades\Whmcs;
use DarthSoup\Whmcs\WhmcsServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            WhmcsServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Whmcs' => Whmcs::class,
        ];
    }
}
