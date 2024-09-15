<?php

namespace App\Providers;

use App\Models\FuelAdjustment;
use App\Models\FuelDip;
use App\Models\FuelDrop;
use App\Models\Transaction;
use App\Observers\FuelAdjustmentObserver;
use App\Observers\FuelDipObserver;
use App\Observers\FuelDropObserver;
use App\Observers\TransactionObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Transaction::observe(TransactionObserver::class);
        FuelAdjustment::observe(FuelAdjustmentObserver::class);
        FuelDrop::observe(FuelDropObserver::class);
    }
}
