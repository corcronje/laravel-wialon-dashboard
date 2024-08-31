<?php

namespace App\Traits;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyTransactions
{
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
