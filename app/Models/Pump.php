<?php

namespace App\Models;

use App\Traits\BelongsToTank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pump extends Model
{
    use HasFactory, SoftDeletes, BelongsToTank;

    protected $fillable = [
        'guid',
        'name',
        'tank_id',
        'description',
        'cents_per_millilitre',
        'pulses_per_millilitre',
        'status',
        'open_scan',
    ];

    protected $casts = [
        'cents_per_millilitre' => 'integer',
        'pulses_per_millilitre' => 'integer',
    ];

    public function getCentsPerLitreAttribute() : float
    {
        return $this->cents_per_millilitre / 100;
    }

    public function getPulsesPerLitreAttribute() : float
    {
        return $this->pulses_per_millilitre / 1000;
    }

    public function tank() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tank::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
