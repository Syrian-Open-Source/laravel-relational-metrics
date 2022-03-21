<?php

namespace SOS\RelationalMetrics\Facades;

use Illuminate\Support\Facades\Facade;
use SOS\RelationalMetrics\Classes\RelationalMetrics;

/**
 * @method RelationalMetrics setExample(string $param)
 */
class RelationalMetricsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RelationalMetricsFacade';
    }
}
