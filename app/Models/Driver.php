<?php

namespace App\Models;

use App\Traits\HasManyOrders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory, SoftDeletes, HasManyOrders;

    protected $fillable = ['employee_number', 'name'];  
}
