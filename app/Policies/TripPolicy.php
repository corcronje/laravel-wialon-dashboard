<?php

namespace App\Policies;

use App\Models\Driver;
use App\Models\Trip;
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
    public function create(User $user): Response
    {
        /* if($driver->has('trips')->where('status', 'pending')->count() > 0)
        {
            return Response::deny('You can not create a trip for a driver who is currently on a trip.');
        } */

        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Trip $trip): Response
    {
        return Response::deny('You are not allowed to update this trip.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Trip $trip): Response
    {
        if($trip->status === 'pending')
        {
            return Response::allow();
        }

        return Response::deny('You are not allowed to delete this trip.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Trip $trip): Response
    {
        return Response::deny('You are not allowed to restore this trip.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Trip $trip): Response
    {
        return Response::deny('You are not allowed to delete this trip.');
    }

    public function close(User $user, Trip $trip): Response
    {
        if($trip->status === 'pending')
        {
            return Response::allow();
        }

        return Response::deny('You can not close this trip.');
    }

    public function swap(User $user, Trip $trip): Response
    {
        if($trip->status === 'pending')
        {
            return Response::allow();
        }

        return Response::deny('You can not swap a driver for this trip.');
    }
}
