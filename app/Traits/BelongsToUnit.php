<?php

namespace App\Traits;

use App\Models\Unit;

trait BelongsToUnit
{
    public function pump(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
