<?php

namespace App\Traits;

use App\Models\Order;

trait HasManyOrders
{
    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeWithPendingOrders($query)
    {
        return $query->whereHas('orders', function ($query) {
            $query->where('status', 'pending');
        });
    }

    public function scopeWithoutPendingOrders($query)
    {
        return $query->whereDoesntHave('orders', function ($query) {
            $query->where('status', 'pending');
        });
    }

    public function hasPendingOrder()
    {
        return $this->orders()->where('status', 'pending')->exists();
    }
}
