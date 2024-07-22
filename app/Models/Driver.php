<?php

namespace App\Models;

use App\Traits\HasManyOrders;
use App\Traits\HasManyTrips;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory, SoftDeletes, HasManyOrders, HasManyTrips;

    protected $fillable = ['employee_number', 'name'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getEmployeeNumberAndNameAttribute()
    {
        return "{$this->employee_number} - {$this->name}";
    }
}
