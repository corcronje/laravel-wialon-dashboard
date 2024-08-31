<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'driver_id',
        'unit_id',
        'pump_id',
        'volume_in_liters',
        'amount_in_cents',
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

    public function pump()
    {
        return $this->belongsTo(Pump::class);
    }
}
