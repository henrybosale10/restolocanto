<?php

namespace App\Providers;

use App\Services\MaxicashService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Enregistrer MaxicashService dans le container
        $this->app->singleton(MaxicashService::class, function ($app) {
            return new MaxicashService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


    }
}
