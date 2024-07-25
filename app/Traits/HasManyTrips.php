<?php

namespace App\Traits;

use App\Models\Trip;

trait HasManyTrips
{
    public function trips(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Trip::class);
    }

    public function scopeWithPendingTrips($query)
    {
        return $query->whereHas('trips', function ($query) {
            $query->where('status', 'pending');
        });
    }

    public function scopeWithoutPendingTrips($query)
    {
        return $query->whereDoesntHave('trips', function ($query) {
            $query->where('status', 'pending');
        });
    }

    public function hasPendingTrip()
    {
        return $this->trips()->where('status', 'pending')->exists();
    }
}
