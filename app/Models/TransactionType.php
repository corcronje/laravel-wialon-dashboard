<?php

namespace App\Models;

use App\Traits\HasManyTransactions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionType extends Model
{
    use HasFactory, SoftDeletes, HasManyTransactions;

    public const FUEL_DISPENSED = 100;
    public const FUEL_ADJUSTMENT = 200;
    public const FUEL_DIP = 300;
    public const FUEL_DROP = 400;
    public const FUEL_TRANSFER = 500;

    protected $fillable = [
        'name',
    ];
}
