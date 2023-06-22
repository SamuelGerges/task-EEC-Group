<?php

namespace App\Providers;

use App\Repositories\Implementation\PharmacyProductRepositry;
use App\Repositories\Implementation\PharmacyRepositry;
use App\Repositories\Implementation\ProductRepositry;
use App\Repositories\IPharmacy;
use App\Repositories\IPharmacyProduct;
use App\Repositories\IProduct;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IProduct::class,ProductRepositry::class);
        $this->app->bind(IPharmacy::class,PharmacyRepositry::class);
        $this->app->bind(IPharmacyProduct::class,PharmacyProductRepositry ::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
