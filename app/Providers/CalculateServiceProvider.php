<?php

namespace App\Providers;

use App\Services\CalculateService;
use App\Services\Contracts\CalculateContract;
use Illuminate\Support\ServiceProvider;

class CalculateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CalculateContract::class, CalculateService::class);
      //$this->app->singleton(CalculateContract::class, CalculateService::class);
        $this->app->alias(CalculateService::class, 'price');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
