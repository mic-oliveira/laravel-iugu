<?php

namespace Iugu\Providers;

use Illuminate\Support\ServiceProvider;
use Iugu\Console\IuguInstallCommand;
use Iugu\Console\IuguRollbackCommand;

class IuguServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/iugu_config.php' => config_path('iugu.php'),
        ]);
        $this->loadMigrationsFrom([
            __DIR__ . '/../../database/migrations'
        ]);
        if ($this->app->runningInConsole()) {
            $this->commands([
                IuguInstallCommand::class,
            ]);
        }
        $this->mergeConfigFrom(
            __DIR__.'/../../config/iugu_config.php', 'iugu'
        );
    }

}
