<?php

namespace App\Traits;

use App\Models\Unit;

trait BelongsToUnit
{
    public function unit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
