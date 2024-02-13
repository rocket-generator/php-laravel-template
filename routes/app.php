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

    /* [APP_ROUTES] */

});
