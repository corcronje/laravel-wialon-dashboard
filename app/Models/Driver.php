<?php

namespace App\Models;

use App\Traits\HasManyOrders;
use App\Traits\HasManyTrips;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory, SoftDeletes, HasManyOrders, HasManyTrips;

    protected $fillable = ['employee_number', 'name', 'lastname', 'said_number'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getFullnameAttribute()
    {
        return "{$this->name} {$this->lastname}";
    }

    public function getEmployeeNumberAndNameAttribute()
    {
        return "{$this->employee_number} - {$this->name}";
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->whereDoesntHave('trips', function ($query) {
            $query->where('status', 'pending');
        });
    }
}
