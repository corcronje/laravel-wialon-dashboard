<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];

    public const ADMIN = 1;
    public const USER = 2;

    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }

    public function isAdmin() : bool
    {
        return $this->name === self::ADMIN;
    }

    public function isUser() : bool
    {
        return $this->name === self::USER;
    }

    public function scopeAdmins(Builder $query) : Builder
    {
        return $query->where('name', self::ADMIN);
    }

    public function scopeUsers(Builder $query) : Builder
    {
        return $query->where('name', self::USER);
    }
}
