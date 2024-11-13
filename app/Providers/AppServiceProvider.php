<?php

namespace App\Providers;

use App\Services\MerchantService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        // Bind the MerchantService into the service container
        $this->app->bind(MerchantService::class, function($app) {
            return new MerchantService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
