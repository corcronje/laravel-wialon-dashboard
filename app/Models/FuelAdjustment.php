<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuelAdjustment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'tank_id',
        'volume_in_litres',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tank()
    {
        return $this->belongsTo(Tank::class);
    }
}
