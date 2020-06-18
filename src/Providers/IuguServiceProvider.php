<?php

namespace Iugu\Providers;

use Illuminate\Support\ServiceProvider;

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
            __DIR__ . '/../../config/iugu_config.php' => config_path('iugu.php')
        ]);
        $this->loadMigrationsFrom([
            __DIR__ . '/../../database/migrations'
        ]);
        $this->loadFactoriesFrom(
            __DIR__ . '/../../database/factories'
        );
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
    }

}
