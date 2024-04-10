<?php

namespace App\Providers;

use App\Services\CheckoutService;
use App\Services\Interfaces\ICheckoutService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public array $bindings = [
        ICheckoutService::class => CheckoutService::class,
    ];

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
        //
    }
}
