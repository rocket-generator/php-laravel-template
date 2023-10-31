<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'status' => 'ok',
    ]);
});

Route::get('/healthz', function () {

    try {
        \DB::connection()->getPDO();
        $databaseName = \DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Database connection failed',
        ])->setStatusCode(500);
    }

    return response()->json([
        'status' => 'ok',
    ]);
});
