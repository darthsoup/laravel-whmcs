<?php

namespace DarthSoup\Whmcs\Adapter;

/**
 * Interface ConnectorInterface
 */
interface ConnectorInterface
{
    public function connect(array $config);
}