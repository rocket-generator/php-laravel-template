<?php

/* [APP_CONTROLLER_IMPORT] */
/* [ADMIN_CONTROLLER_IMPORT] */

use App\Http\Controllers\Api\Auth\MeGetController;
use App\Http\Controllers\Api\Auth\MePutController;
use App\Http\Controllers\Api\Auth\PasswordForgotPostController;
use App\Http\Controllers\Api\Auth\PasswordResetPostController;
use App\Http\Controllers\Api\Auth\SignInPostController;
use App\Http\Controllers\Api\Auth\SignUpPostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => 'auth',
    'namespace' => 'auth',
    'as' => 'auth.',
], function ($router): void {
    $router->post('signin', [SignInPostController::class, '__invoke'])->name('signin');
    $router->post('signup', [SignUpPostController::class, '__invoke'])->name('signup');
    $router->group([
        'prefix' => 'password',
        'as' => 'password.',
    ], function ($router): void {
        $router->post('forgot', [PasswordForgotPostController::class, '__invoke'])->name('forgot');
        $router->post('reset', [PasswordResetPostController::class, '__invoke'])->name('reset');
    });
});

Route::group([
    'middleware' => ['auth:app'],
    'as' => 'me.',
], function ($router): void {
    $router->get('me', [MeGetController::class, '__invoke'])->name('get');
    $router->match(['PUT', 'PATCH'], 'me', [MePutController::class, '__invoke'])->name('update');
});

Route::group([
    'namespace' => 'app',
    'as' => 'app.',
], function ($router): void {
    Route::group([
        'middleware' => ['auth:app'],
    ], function ($router): void {
        /* [APP_ROUTES] */
    });
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
], function ($router): void {
    Route::group([
        'middleware' => ['auth:app', 'permission:admin'],
    ], function ($router): void {
        Route::apiResource('users', \App\Http\Controllers\Api\Admin\UsersController::class);
        /* [ADMIN_ROUTES] */
    });
});
