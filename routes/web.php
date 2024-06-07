<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResetUnitController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('units', UnitController::class)->only(['index', 'show']);
    Route::put('units/{unit}/reset', ResetUnitController::class)->name('units.reset');
    Route::resource('drivers', DriverController::class);
    Route::resource('users', UserController::class);
    Route::resource('profile', ProfileController::class)->only(['index', 'update']);
    Route::resource('orders', OrderController::class);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('orders/{order}/close', [OrderController::class, 'close'])->name('orders.close');
    Route::post('orders/{order}/close', [OrderController::class, 'fulfill'])->name('orders.fulfill');
});
