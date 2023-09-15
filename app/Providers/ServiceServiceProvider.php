<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            \App\Contracts\Services\AdminUserServiceInterface::class,
            \App\Services\AdminUserService::class
        );

        /* [REGISTER_SERVICES] */
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
