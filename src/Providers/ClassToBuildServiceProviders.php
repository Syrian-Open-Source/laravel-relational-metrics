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
        $this->publishes([
            __DIR__.'/../Config/package_config.php' => config_path('package_config.php'),
        ], 'config-command');
    }

    /**
     *
     *
     * @author your name
     */
    private function resolveCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }
}
