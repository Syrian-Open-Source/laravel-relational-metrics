<?php

namespace SOS\RelationalMetrics\Providers;

use Illuminate\Support\ServiceProvider;
use SOS\RelationalMetrics\Classes\RelationalMetrics;

class RelationalMetricsServiceProviders extends ServiceProvider
{
    /**
     * register package dependencies.
     *
     * @author karam mustafa
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
     * @author karam mustafa
     */
    public function register()
    {
    }

    /**
     *
     */
    protected function registerFacades()
    {
        $this->app->singleton('RelationalMetricsFacade', function () {
            return new RelationalMetrics();
        });
    }

    /**
     * publish files if exists.
     *
     * @author karam mustafa
     */
    protected function publishesPackages()
    {
    }

    /**
     * init command if exists.
     *
     * @author karam mustafa
     */
    private function resolveCommands()
    {
    }
}
