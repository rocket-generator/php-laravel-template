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
            \App\Contracts\UseCases\PostAuthSignInUseCaseInterface::class,
            \App\UseCases\PostAuthSignInUseCase::class
        );
        $this->app->singleton(
            \App\Contracts\UseCases\PostAuthSignUpUseCaseInterface::class,
            \App\UseCases\PostAuthSignUpUseCase::class
        );
        $this->app->singleton(
            \App\Contracts\UseCases\PostAuthPasswordForgotUseCaseInterface::class,
            \App\UseCases\PostAuthPasswordForgotUseCase::class
        );
        $this->app->singleton(
            \App\Contracts\UseCases\PostAuthPasswordResetUseCaseInterface::class,
            \App\UseCases\PostAuthPasswordResetUseCase::class
        );
        $this->app->singleton(
            \App\Contracts\UseCases\GetMeUseCaseInterface::class,
            \App\UseCases\GetMeUseCase::class
        );
        $this->app->singleton(
            \App\Contracts\UseCases\PutMeUseCaseInterface::class,
            \App\UseCases\PutMeUseCase::class
        );

        /* [REGISTER_USECASES] */
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
