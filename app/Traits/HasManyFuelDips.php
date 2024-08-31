<?php

namespace App\Traits;

use App\Models\FuelDip;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyFuelDips
{
    public function dips(): HasMany
    {
        return $this->hasMany(FuelDip::class);
    }
}
