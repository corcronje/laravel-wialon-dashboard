<?php

namespace App\Models;

use App\Traits\BelongsToDriver;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes, BelongsToUser, BelongsToDriver;

    protected $fillable = [
        'unit_id',
        'user_id',
        'driver_id',
        'order_number',
        'fuel_consumed_litres',
        'fuel_allowed_litres',
        'fuel_replenished_litres',
        'mileage_km',
        'distance_travelled_km',
        'status'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }
}
