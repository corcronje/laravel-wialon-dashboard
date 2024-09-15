<?php

namespace App\Observers;

use App\Models\FuelDip;
use App\Models\Transaction;
use App\Models\TransactionType;

class FuelDipObserver
{
    /**
     * Handle the FuelDip "created" event.
     */
    public function created(FuelDip $fuelDip): void
    {
        $currentTankVolume = $fuelDip->tank->current_volume_in_millilitres;
        $variance = $fuelDip->volume_in_millilitres - $currentTankVolume;

        Transaction::create([
            'transaction_type_id' => TransactionType::FUEL_DIP,
            'description' => 'Fuel Dip',
            'volume_in_millilitres' => abs($variance),
            'amount_in_cents' => 0,
            'meta' => [
                'drop' => $fuelDip,
            ],
            'user_id' => $fuelDip->user_id,
            'tank_id' => $fuelDip->tank_id,
        ]);
    }

    /**
     * Handle the FuelDip "updated" event.
     */
    public function updated(FuelDip $fuelDip): void
    {
        //
    }

    /**
     * Handle the FuelDip "deleted" event.
     */
    public function deleted(FuelDip $fuelDip): void
    {
        //
    }

    /**
     * Handle the FuelDip "restored" event.
     */
    public function restored(FuelDip $fuelDip): void
    {
        //
    }

    /**
     * Handle the FuelDip "force deleted" event.
     */
    public function forceDeleted(FuelDip $fuelDip): void
    {
        //
    }
}
