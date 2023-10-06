<?php

/* [APP_CONTROLLER_IMPORT] */
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
    Route::group([
        'prefix' => 'auth',
    ], function ($router): void {
        // $router->post('registration', [AuthController::class, 'registration']);
    });

    Route::group([
        'middleware' => ['auth:app'],
    ], function ($router): void {
        // $router->get('me', [MeController::class, 'getMe']);
        // $router->put('me', [MeController::class, 'updateMe']);
    });

    /* [APP_ROUTES] */

});
