<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'driver_id',
        'unit_id',
        'data',
        'status',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    public function close()
    {
        $data = $this->data;
        $data['unit_data_end'] = $this->unit()->get()->first()->toArray();
        $data['end_at'] = now();

        $this->update([
            'data' => $data,
            'status' => 'closed',
        ]);

        return $this;
    }

    public function getPreviousTripAttribute(): ?Trip
    {
        if(!isset($this->data['previous_trip_id'])) {
            return null;
        }

        return Trip::find($this->data['previous_trip_id']);
    }

    public function getDistanceTravelledKmAttribute(): int
    {
        // if we don't have the start mileage, we can't calculate the distance
        if(!isset($this->data['unit_data_start']['mileage_km'])) {
            return 0;
        }

        // if the trip is pending, we use the latest unit mileage
        if($this->status === 'pending') {
            return $this->unit()->get()->first()->mileage_km - $this->data['unit_data_start']['mileage_km'];
        }

        if(!isset($this->data['unit_data_start']['mileage_km']) || !isset($this->data['unit_data_end']['mileage_km'])) {
            return 0;
        }

        return $this->data['unit_data_end']['mileage_km'] - $this->data['unit_data_start']['mileage_km'];
    }

    public function getFuelConsumedLitresAttribute(): int
    {
        // if we don't have the starting fuel consumption, we can't calculate the fuel consumed
        if(!isset($this->data['unit_data_start']['fuel_consumed_litres'])) {
            return 0;
        }

        // if the trip is pending, we use the latest unit fuel consumption
        if($this->status === 'pending') {
            return $this->unit()->get()->first()->fuel_consumed_litres - $this->data['unit_data_start']['fuel_consumed_litres'];
        }

        if(!isset($this->data['unit_data_start']['fuel_consumed_litres']) || !isset($this->data['unit_data_end']['fuel_consumed_litres'])) {
            return 0;
        }

        return $this->data['unit_data_end']['fuel_consumed_litres'] - $this->data['unit_data_start']['fuel_consumed_litres'];
    }
}
