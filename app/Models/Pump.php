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
    ];
}
