<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            \App\Contracts\UseCases\PostAuthAuthorizeUseCaseInterface::class,
            \App\UseCases\PostAuthAuthorizeUseCase::class
        );
        $this->app->singleton(
            \App\Contracts\UseCases\PostAuthPasswordForgotUseCaseInterface::class,
            \App\UseCases\PostAuthPasswordForgotUseCase::class
        );
        $this->app->singleton(
            \App\Contracts\UseCases\PostAuthPasswordResetUseCaseInterface::class,
            \App\UseCases\PostAuthPasswordResetUseCase::class
        );

        /* [REGISTER_USECASES] */
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
