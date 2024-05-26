<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('units', UnitController::class)->only(['index', 'show']);
    Route::resource('orders', OrderController::class);
    Route::get('orders/{order}/close', [OrderController::class, 'close'])->name('orders.close');
    Route::post('orders/{order}/close', [OrderController::class, 'fulfill'])->name('orders.fulfill');
});
