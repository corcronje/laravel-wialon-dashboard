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
        'current_volume_in_millilitres',
    ];

    protected $casts = [
        'volume_in_millilitres' => 'integer',
        'current_volume_in_millilitres' => 'integer',
    ];

    public function pumps(): HasMany
    {
        return $this->hasMany(Pump::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
