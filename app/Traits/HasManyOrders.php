<?php

namespace App\Traits;

use App\Models\Order;

trait HasManyOrders
{
    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }
}
