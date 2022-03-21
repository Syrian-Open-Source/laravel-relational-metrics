<?php

namespace SOS\RelationalMetrics\Providers;

use Illuminate\Support\ServiceProvider;
use SOS\RelationalMetrics\Classes\RelationalMetrics;

class RelationalMetricsServiceProviders extends ServiceProvider
{
    /**
     *
     *
     * @author your name
     */
    public function boot()
    {
        $this->publishesPackages();
        $this->resolveCommands();
        $this->registerFacades();
    }

    /**
     *
     *
     * @author your name
     */
    public function register()
    {
    }

    /**
     *
     */
    protected function registerFacades()
    {
        $this->app->singleton('RelationalMetricsFacade', function ($data) {
            return new RelationalMetrics($data);
        });
    }

    /**
     * publish files
     *
     * @author your name
     */
    protected function publishesPackages()
    {
    }

    /**
     *
     *
     * @author your name
     */
    private function resolveCommands()
    {
    }
}
