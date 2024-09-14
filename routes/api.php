<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionController as ApiTransactionController;
use App\Http\Controllers\Api\DriverController as ApiDriverController;
use App\Http\Controllers\Api\PumpController as ApiPumpController;
use App\Http\Controllers\Api\UnitController as ApiUnitController;
use App\Http\Controllers\Api\OrderController as ApiOrderController;
use App\Http\Middleware\EnsurePumpGuidIsPresentAndValid;

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the Fuel API'
    ]);
});

Route::middleware(EnsurePumpGuidIsPresentAndValid::class)->name('api.')->group(function () {
    Route::resource('transactions', ApiTransactionController::class)->only(['store']);
    Route::resource('drivers', ApiDriverController::class)->only(['index']);
    Route::get('pumps/{guid}', [ApiPumpController::class, 'index'])->name('pumps.index');
    Route::resource('units', ApiUnitController::class)->only(['index']);
    Route::resource('orders', ApiOrderController::class)->only(['index']);
});
