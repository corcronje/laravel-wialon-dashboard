<?php

namespace App\Traits;

use App\Models\Driver;

trait BelongsToDriver
{
    public function driver(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }
}
