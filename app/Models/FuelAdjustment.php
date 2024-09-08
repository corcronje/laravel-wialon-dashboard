<?php

namespace App\Models;

use App\Traits\BelongsToTank;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuelAdjustment extends Model
{
    use HasFactory, SoftDeletes, BelongsToTank, BelongsToUser;

    protected $fillable = [
        'user_id',
        'tank_id',
        'volume_in_millilitres',
    ];
}
