<?php

namespace App\Models;

use App\Traits\BelongsToDriver;
use App\Traits\BelongsToPump;
use App\Traits\BelongsToTank;
use App\Traits\BelongsToUnit;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes, BelongsToUser, BelongsToDriver, BelongsToPump, BelongsToUnit, BelongsToTank;

    protected $fillable = [
        'user_id',
        'driver_id',
        'pump_id',
        'tank_id',
        'unit_id',
        'transaction_type_id',
        'description',
        'volume_in_millilitres',
        'amount_in_cents',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
