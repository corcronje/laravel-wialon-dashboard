<?php

namespace App\Observers;

use App\Models\FuelDrop;
use App\Models\Transaction;
use App\Models\TransactionType;

class FuelDropObserver
{
    /**
     * Handle the FuelDrop "created" event.
     */
    public function created(FuelDrop $fuelDrop): void
    {
        Transaction::create([
            'transaction_type_id' => TransactionType::FUEL_ADJUSTMENT,
            'description' => 'Fuel Drop',
            'volume_in_millilitres' => abs($fuelDrop->volume_in_millilitres),
            'amount_in_cents' => 0,
            'meta' => [
                'adjustment' => $fuelDrop,
            ],
            'user_id' => $fuelDrop->user_id,
            'tank_id' => $fuelDrop->tank_id,
        ]);
    }

    /**
     * Handle the FuelDrop "updated" event.
     */
    public function updated(FuelDrop $fuelDrop): void
    {
        //
    }

    /**
     * Handle the FuelDrop "deleted" event.
     */
    public function deleted(FuelDrop $fuelDrop): void
    {
        //
    }

    /**
     * Handle the FuelDrop "restored" event.
     */
    public function restored(FuelDrop $fuelDrop): void
    {
        //
    }

    /**
     * Handle the FuelDrop "force deleted" event.
     */
    public function forceDeleted(FuelDrop $fuelDrop): void
    {
        //
    }
}
