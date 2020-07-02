<?php

namespace Iugu\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Iugu\Console\IuguInstallCommand;
use Iugu\Models\Customer;
use Iugu\Models\Invoice;
use Iugu\Models\PaymentMethod;
use Iugu\Models\Plan;
use Iugu\Models\Subscription;

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
                IuguInstallCommand::class
            ]);
        }
    }

}
