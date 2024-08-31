<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tank extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'volume_in_liters',
        'current_volume_in_liters',
    ];

    protected $casts = [
        'volume_in_liters' => 'integer',
        'current_volume_in_liters' => 'integer',
    ];

    public function pumps() : HasMany
    {
        return $this->hasMany(Pump::class);
    }

    public function transactions() : HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
