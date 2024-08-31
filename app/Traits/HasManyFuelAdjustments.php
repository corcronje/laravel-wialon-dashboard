<?php

namespace App\Traits;

use App\Models\FuelAdjustment;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyFuelAdjustments
{
    public function adjustments(): HasMany
    {
        return $this->hasMany(FuelAdjustment::class);
    }
}
