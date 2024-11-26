<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\MovieController;
use App\Http\Controllers\Api\V1\WatchlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "api" middleware group. Make something great!
 * |
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    // Auth Routes
    Route::post('register', [AuthController::class, 'register'])->name('auth-register');
    Route::post('login', [AuthController::class, 'login'])->name('auth-login');

    // Routes guarded by sanctum, need token to access.
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('watchlists', WatchlistController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
        Route::apiResource('movies', MovieController::class)->only('index', 'show', 'store', 'destroy');
        Route::post('logout', [AuthController::class, 'logout'])->name('auth-logout');
    });
});
