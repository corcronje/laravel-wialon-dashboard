<?php

namespace App\Policies;

use App\Models\Driver;
use App\Models\Order;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Order $order): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Unit $unit, Driver $driver): Response
    {
        // cannot create an order if the driver a pending order
        if($driver->hasPendingOrder()) {
            return Response::deny('The driver a pending order.');
        }

        // cannot create an order if the unit a pending order
        if($unit->hasPendingOrder()) {
            return Response::deny('The unit has a pending order.');
        }

        // cannot create an order if the driver has a pending trip and the trip's driver_id and trip's unit_id are note equal to the driver and unit ids
        if($driver->hasPendingTrip() && ($driver?->pendingTrip?->driver_id !== $driver->id || $driver?->pendingTrip?->unit_id !== $unit->id)) {
            return Response::deny('The driver is on a trip with another unit.');
        }

        // cannot create an order if the unit has a pending trip and the trip's driver_id and trip's unit_id are note equal to the driver and unit ids
        if($unit->hasPendingTrip() && ($unit?->pendingTrip?->unit_id !== $unit->id || $unit?->pendingTrip?->driver_id !== $driver->id)) {
            return Response::deny('The unit is on a trip with another driver.');
        }

        return $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('You are not authorized to create orders.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Order $order): Response
    {
        if($order->status === 'closed') {
            return Response::deny('This order has already been fulfilled.');
        }

        if($user->hasRole('admin')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to update this order.');
    }

    /**
     * Determine whether the user can close the model.
     */
    public function close(User $user, Order $order): Response
    {
        if($order->status === 'pending') {
            return Response::allow();
        }

        return Response::deny('This order is already closed.');
    }


    /**
     * Determine whether the user can fulfill the model.
     */
    public function fulfill(User $user, Order $order): Response
    {
        if($order->status === 'closed') {
            return Response::deny('This order has already been fulfilled.');
        }

        return $user->id === $order->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to fulfill this order.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Order $order): Response
    {
        if($order->status === 'closed') {
            return Response::deny('This order has already been fulfilled.');
        }

        return $user->id === $order->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to delete this order.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Order $order): Response
    {
        return $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('You are not authorized to restore this order.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Order $order): Response
    {
        return $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('You are not authorized to permanently delete this order.');
    }
}
