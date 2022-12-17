<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TransportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('transports', [TransportController::class, 'create']);
    Route::put('transports/{id}', [TransportController::class, 'update']);
    Route::delete('transports/{id}', [TransportController::class, 'destroy']);

    Route::post('drivers', [DriverController::class, 'create']);
    Route::put('drivers/{id}', [DriverController::class, 'update']);
    Route::delete('drivers/{id}', [DriverController::class, 'destroy']);

});


Route::get('drivers', [DriverController::class, 'index']);
Route::get('drivers/{id}', [DriverController::class, 'show']);

Route::get('transports', [TransportController::class, 'index']);
Route::get('transports/{id}', [TransportController::class, 'show']);