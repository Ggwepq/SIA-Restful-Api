<?php

use App\Http\Controllers\Api\V1\MovieController;
use App\Http\Controllers\Api\V1\WatchlistController;
use App\Models\User;
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

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::apiResource('user', User::class);
    Route::apiResource('watchlist', WatchlistController::class);
    Route::apiResource('movies', MovieController::class);

    // Route::post('invoices/bulk', [InvoiceController::class, 'bulkStore']);
});
