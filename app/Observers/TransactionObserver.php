<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Models\TransactionType;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        // adjust the tank volume
        if($transaction->transaction_type_id === TransactionType::FUEL_DISPENSED)
        {
            $tank = $transaction->pump->tank;

            $currentVolumeInMillilitres = $tank->current_volume_in_millilitres;

            $tank->current_volume_in_millilitres = $currentVolumeInMillilitres - abs($transaction->volume_in_millilitres);

            $tank->save();
        }
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
