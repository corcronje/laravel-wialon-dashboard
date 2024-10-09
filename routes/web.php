<?php

use App\Http\Controllers\AttendantController;
use App\Http\Controllers\CloseTripController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FuelAdjustmentController;
use App\Http\Controllers\FuelDipController;
use App\Http\Controllers\FuelDropController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PumpController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResetUnitController;
use App\Http\Controllers\SwapDriverController;
use App\Http\Controllers\TankController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('units', UnitController::class)->only(['index', 'show', 'edit', 'update']);
    Route::put('units/{unit}/reset', ResetUnitController::class)->name('units.reset');
    Route::resource('tanks', TankController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('attendants', AttendantController::class);
    Route::resource('users', UserController::class);
    Route::resource('profile', ProfileController::class)->only(['index', 'update']);
    Route::resource('orders', OrderController::class);
    Route::resource('trips', TripController::class);
    Route::resource('pumps', PumpController::class);
    Route::resource('dips', FuelDipController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('drops', FuelDropController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('adjustments', FuelAdjustmentController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('transactions', TransactionController::class)->only(['index', 'create', 'store', 'show']);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('orders/{order}/close', [OrderController::class, 'close'])->name('orders.close');
    Route::post('orders/{order}/close', [OrderController::class, 'fulfill'])->name('orders.fulfill');
    Route::post('trips/{trip}/close', CloseTripController::class)->name('trips.close');
    Route::post('trips/{trip}/swap', SwapDriverController::class)->name('trips.swap');
});
