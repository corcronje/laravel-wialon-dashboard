<?php

namespace App\Traits;

use App\Models\Tank;

trait BelongsToTank
{
    public function tank(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tank::class);
    }
}
