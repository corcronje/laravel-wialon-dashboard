<?php

namespace App\Policies;

use App\Models\Driver;
use App\Models\Trip;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TripPolicy
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
    public function view(User $user, Trip $trip): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Unit $unit, Driver $driver): Response
    {
        // cannot create a trip if the driver has a pending trip
        if ($driver->hasPendingTrip()) {
            return Response::deny('The driver is out on another shift.');
        }

        // cannot create a trip if the unit has a pending trip
        if ($unit->hasPendingTrip()) {
            return Response::deny('The unit is out on another shift.');
        }

        // cannot create a trip if the driver has a pending order
        if ($driver->hasPendingOrder()) {
            return Response::deny('The driver has a pending order.');
        }

        // cannot create a trip if the unit has a pending order
        if ($unit->hasPendingOrder()) {
            return Response::deny('The unit has a pending order.');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Trip $trip): Response
    {
        return Response::deny('You are not allowed to update this shift.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Trip $trip): Response
    {
        if ($trip->status === 'pending') {
            return Response::allow();
        }

        return Response::deny('You are not allowed to delete this shift.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Trip $trip): Response
    {
        return Response::deny('You are not allowed to restore this shift.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Trip $trip): Response
    {
        return Response::deny('You are not allowed to delete this shift.');
    }

    public function close(User $user, Trip $trip): Response
    {
        if ($trip->status === 'pending') {
            return Response::allow();
        }

        return Response::deny('You can not close this shift.');
    }

    public function swap(User $user, Trip $trip): Response
    {
        if ($trip->status === 'pending') {
            return Response::allow();
        }

        return Response::deny('You can not swap a driver for this shift.');
    }
}
