<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Whmcs.
 */
class Whmcs extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'whmcs';
    }
}
