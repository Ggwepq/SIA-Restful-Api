<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
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

Route::group(['prefix' => 'v1'], function () {
    // Authenticate user
    Route::post('register', [AuthController::class, 'register'])->name('auth-register');
    Route::post('login', [AuthController::class, 'login'])->name('auth-login');

    // Protected controllers using sanctum
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::apiResource('customers', CustomerController::class)->only('index', 'store', 'show', 'update');
        Route::apiResource('invoices', InvoiceController::class)->only('index', 'show', 'bulkStore');

        // Store bulk data
        Route::post('invoices/bulk', [InvoiceController::class, 'bulkStore']);

        // Remove token
        Route::post('logout', [AuthController::class, 'logout'])->name('auth-logout');
    });
});
