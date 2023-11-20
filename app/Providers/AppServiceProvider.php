<?php

namespace App\Providers;

use App\Services\GeolocationService;
use App\Services\Providers\Geo1Provider;
use App\Services\Providers\Geo2Provider;
use App\Services\Providers\Geo3Provider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(GeolocationService::class, function ($app) {
            return new GeolocationService([
                $app->make(Geo1Provider::class),
//                $app->make(Geo2Provider::class),
//                $app->make(Geo3Provider::class),
                // Add more geolocators as needed
            ]);
        });

    }
}
