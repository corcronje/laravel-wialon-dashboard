<?php

namespace App\Traits;

use App\Models\TransactionType;

trait BelongsToTransactionType
{
    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }
}
