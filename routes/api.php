<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionController as ApiTransactionController;
use App\Http\Controllers\Api\DriverController as ApiDriverController;
use App\Http\Controllers\Api\PumpController as ApiPumpController;
use App\Http\Controllers\Api\UnitController as ApiUnitController;
use App\Http\Controllers\Api\OrderController as ApiOrderController;
use App\Http\Middleware\EnsurePumpGuidIsPresentAndValid;

Route::middleware(EnsurePumpGuidIsPresentAndValid::class)->name('api.')->group(function () {
    Route::resource('transactions', ApiTransactionController::class)->only(['create']);
    Route::resource('drivers', ApiDriverController::class)->only(['index']);
    Route::resource('pumps', ApiPumpController::class)->only(['index']);
    Route::resource('units', ApiUnitController::class)->only(['index']);
    Route::resource('orders', ApiOrderController::class)->only(['index']);
});
