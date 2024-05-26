<?php

namespace App\Models;

use App\Observers\UnitObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(UnitObserver::class)]
class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['wialon_id', 'wialon_nm', 'fuel_consumed_litres', 'fuel_replenished_litres', 'mileage_km'];

    protected $casts = [
        'fuel_consumed_litres' => 'integer',
        'fuel_replenished_litres' => 'integer',
        'mileage_km' => 'integer',
    ];

    public function getFuelAllowedLitresAttribute(): int
    {
        return $this->fuel_consumed_litres - $this->fuel_replenished_litres;
    }
}
