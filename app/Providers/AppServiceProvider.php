<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Product', function()
        {
            return new Product;
        });
        $this->app->bind('Basket', function()
        {
            return new Basket;
        });
        $this->app->bind('Order', function()
        {
            return new Order;
        });

        $this->app->bind('SuperForm', function()
        {
            return new SuperForm;
        });
    }
}
