<?php

namespace App\Models;

use App\Observers\UnitObserver;
use App\Traits\HasManyOrders;
use App\Traits\HasManyTrips;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(UnitObserver::class)]

class Unit extends Model
{
    use HasFactory, SoftDeletes, HasManyOrders, HasManyTrips;

    protected $fillable = [
        'wialon_id',
        'wialon_nm',
        'wialon_mileage_sensor_id',
        'wialon_mileage_sensor_calibration_factor',
        'wialon_fuel_consumption_sensor_id',
        'wialon_fuel_consumption_sensor_calibration_factor',
        'fuel_consumed_litres',
        'fuel_replenished_litres',
        'mileage_km',
        'mileage_replenished_km',
        'reset_at',
        'data',
        'tag_id'
    ];

    protected $casts = [
        'fuel_consumed_litres' => 'integer',
        'fuel_replenished_litres' => 'integer',
        'mileage_km' => 'integer',
        'data' => 'array'
    ];

    protected $appends = [
        'fuel_allowed_litres',
        'distance_travelled_km',
        'fuel_consumption_litres_per_km',
        'fuel_consumption_km_per_litre'
    ];

    public function getFuelAllowedLitresAttribute(): int
    {
        return $this->fuel_consumed_litres - $this->fuel_replenished_litres;
    }

    public function getDistanceTravelledKmAttribute(): int
    {
        return $this->mileage_km - $this->mileage_replenished_km;
    }

    public function getFuelConsumptionLitresPerKmAttribute(): float
    {
        if ($this->mileage_km === 0) {
            return 0;
        }

        return $this->fuel_consumed_litres / $this->mileage_km;
    }

    public function getFuelConsumptionKmPerLitreAttribute(): float
    {
        if ($this->fuel_consumed_litres === 0) {
            return 0;
        }

        return $this->mileage_km / $this->fuel_consumed_litres;
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->whereDoesntHave('trips', function ($query) {
            $query->where('status', 'pending');
        });
    }
}
