<?php

namespace Iugu\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
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
        app()->when([
            Customer::class,
            Invoice::class,
            PaymentMethod::class,
            Plan::class,
            Subscription::class
        ])->needs(Model::class)->give(function ($app) {
            $model=new Model();
            $model->setConnection(config('iugu.connection'));
        });
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
    }

}
