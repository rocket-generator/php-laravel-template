<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\MeController;
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
    'prefix' => 'admin',
    'as' => 'admin.',
], function ($router): void {

    Route::group([
        'prefix' => 'auth',
    ], function ($router): void {
        // $router->post('login', [AuthController::class, 'login']);
        // $router->post('logout', [AuthController::class, 'logout']);
    });

    Route::group([
        'middleware' => ['middleware' => 'auth:admin'],
    ], function ($router): void {

        // Route::apiResource('users', \App\Http\Controllers\Api\Admin\UsersController::class);

    });
});
