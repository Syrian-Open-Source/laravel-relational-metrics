<?php

namespace SOS\RelationalMetrics\Facades;

use Illuminate\Support\Facades\Facade;
use SOS\RelationalMetrics\Classes\RelationalMetrics;

/**
 * @method static RelationalMetrics setModel(string $model)
 * @method static array getBasicMetrics()
 * @method static array getRelationalMetrics($relation, $column, $value)
 * @method static array getConditionalMetrics($conditions)
 * @method static int getCount()
 */
class RelationalMetricsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RelationalMetricsFacade';
    }
}
