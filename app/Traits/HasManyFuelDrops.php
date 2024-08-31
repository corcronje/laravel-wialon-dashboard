<?php

namespace App\Traits;

use App\Models\FuelDrop;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyFuelDrops
{
    public function drops(): HasMany
    {
        return $this->hasMany(FuelDrop::class);
    }
}
