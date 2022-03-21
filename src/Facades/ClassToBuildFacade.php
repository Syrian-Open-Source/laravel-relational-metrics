<?php

namespace SOS\RelationalMetrics\Facades;

use Illuminate\Support\Facades\Facade;
use SOS\LaravelPackageTemplate\Classes\ClassToBuild;

/**
 * @method ClassToBuild setExample(string $param)
 */
class RelationalMetricsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RelationalMetrics';
    }
}
