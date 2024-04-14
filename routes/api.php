<?php

/* [APP_CONTROLLER_IMPORT] */
/* [ADMIN_CONTROLLER_IMPORT] */

use App\Http\Controllers\Api\App\AuthAuthorizePostController;
use App\Http\Controllers\Api\App\AuthPasswordForgotPostController;
use App\Http\Controllers\Api\App\AuthPasswordResetPostController;
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
    'prefix' => 'app',
    'namespace' => 'app',
    'as' => 'app.',
], function ($router): void {

    $router->group([
        'prefix' => 'auth',
        'as' => 'auth.',
    ], function ($router): void {
        $router->post('authorize', [AuthAuthorizePostController::class, '__invoke'])->name('authorize');
        $router->group([
            'prefix' => 'password',
            'as' => 'password.',
        ], function ($router): void {
            $router->post('forgot', [AuthPasswordForgotPostController::class, '__invoke'])->name('forgot');
            $router->post('reset', [AuthPasswordResetPostController::class, '__invoke'])->name('reset');
        });
    });

    /* [APP_ROUTES] */

});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
], function ($router): void {

    $router->group([
        'prefix' => 'auth',
        'as' => 'auth.',
    ], function ($router): void {
        $router->post('authorize', [\App\Http\Controllers\Api\Admin\AuthController::class, 'auth'])->name('authorize');
    });

    Route::group([
        'middleware' => ['middleware' => 'auth:admin'],
    ], function ($router): void {
        Route::apiResource('admin_users', \App\Http\Controllers\Api\Admin\AdminUsersController::class);

        /* [ADMIN_ROUTES] */
    });

});
