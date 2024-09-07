<?php

namespace App\Traits;

use App\Models\Pump;

trait BelongsToPump
{
    public function pump(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pump::class);
    }
}
