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
        'volume_in_millilitres',
        'current_volume_in_millilitres'
    ];

    protected $casts = [
        'volume_in_millilitres' => 'integer',
        'current_volume_in_millilitres' => 'integer',
    ];

    public function getVolumeInLitresAttribute(): float
    {
        return $this->volume_in_millilitres / 1000;
    }

    public function getCurrentVolumeInLitresAttribute(): float
    {
        return $this->current_volume_in_millilitres / 1000;
    }

    public function getCurrentLevelPercentageAttribute(): float
    {
        return ($this->current_volume_in_millilitres / $this->volume_in_millilitres) * 100;
    }

    public function pumps(): HasMany
    {
        return $this->hasMany(Pump::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
