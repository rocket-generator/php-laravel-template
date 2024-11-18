<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/healthz',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append([
            \Illuminate\Http\Middleware\TrustProxies::class,
            \Illuminate\Http\Middleware\HandleCors::class,
            \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
            \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
            \App\Http\Middleware\TrimStrings::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
            \Illuminate\Http\Middleware\HandleCors::class,
        ]);
        $middleware->web([
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
        $middleware->api([
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
            'permission' => \App\Http\Middleware\CheckPermission::class,
            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
            'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
            'can' => \Illuminate\Auth\Middleware\Authorize::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
            'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
            'signed' => \App\Http\Middleware\ValidateSignature::class,
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->dontFlash([
            'current_password',
            'password',
            'password_confirmation',
        ]);
        $exceptions->reportable(function (Throwable $e) {
            if ($e instanceof \App\Exceptions\Api\APIErrorException) {
                return false;
            }
            if ($e instanceof \App\Exceptions\Services\ClientSideException) {
                return false;
            }

            return true;
        });

        $exceptions->renderable(function (Throwable $e) {
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return \App\Http\Resources\Api\Status::error('endpoint not found', 404);
            }
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                return \App\Http\Resources\Api\Status::error(
                    $e->getMessage(),
                    422,
                    \App\Exceptions\Services\ClientSideException::ERROR_INVALID_PARAMETERS,
                    $e->validator->errors()->all()
                );
            }
            if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                return \App\Http\Resources\Api\Status::error($e->getMessage(), 401);
            }
            if ($e instanceof \App\Exceptions\Api\APIErrorException) {
                return \App\Http\Resources\Api\Status::error($e->getMessage(), $e->statusCode, 0);
            }
            if ($e instanceof \App\Exceptions\Services\ClientSideException) {
                return \App\Http\Resources\Api\Status::error($e->getMessage(), $e->statusCode, $e->errorCode);
            }

            return \App\Http\Resources\Api\Status::error($e->getMessage(), 500);
        });
    })->create();
