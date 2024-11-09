<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
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
        if ($this->app->environment('testing')) {
            $this->loadMigrationsFrom(base_path('tests/database/migrations'));
        }

        // Reset Password URL
        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return config('app.frontend_base_url')
                .config('app.frontend_reset_password_path')
                .'?'
                .'token='.$token
                .'&email='.$user->email;
        });
    }
}
