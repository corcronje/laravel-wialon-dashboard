<?php

namespace App\Observers;

use App\Models\FuelAdjustment;
use App\Models\Transaction;
use App\Models\TransactionType;

class FuelAdjustmentObserver
{
    /**
     * Handle the FuelAdjustment "created" event.
     */
    public function created(FuelAdjustment $fuelAdjustment): void
    {
        Transaction::create([
            'transaction_type_id' => TransactionType::FUEL_ADJUSTMENT,
            'description' => 'Fuel Adjustment',
            'volume_in_millilitres' => $fuelAdjustment->volume_in_millilitres,
            'amount_in_cents' => 0,
            'meta' => [
                'adjustment' => $fuelAdjustment,
            ],
            'user_id' => $fuelAdjustment->user_id,
        ]);
    }

    /**
     * Handle the FuelAdjustment "updated" event.
     */
    public function updated(FuelAdjustment $fuelAdjustment): void
    {
        //
    }

    /**
     * Handle the FuelAdjustment "deleted" event.
     */
    public function deleted(FuelAdjustment $fuelAdjustment): void
    {
        //
    }

    /**
     * Handle the FuelAdjustment "restored" event.
     */
    public function restored(FuelAdjustment $fuelAdjustment): void
    {
        //
    }

    /**
     * Handle the FuelAdjustment "force deleted" event.
     */
    public function forceDeleted(FuelAdjustment $fuelAdjustment): void
    {
        //
    }
}
