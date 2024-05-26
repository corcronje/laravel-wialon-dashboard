<?php

namespace App\Policies;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DriverPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        if($user->hasRole('admin')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to view drivers.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Driver $driver): Response
    {
        if($user->hasRole('admin')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to view this driver.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if($user->hasRole('admin')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to create drivers.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Driver $driver): Response
    {
        if($user->hasRole('admin')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to update this driver.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Driver $driver): Response
    {
        if($user->hasRole('admin')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to delete this driver.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Driver $driver): Response
    {
        if($user->hasRole('admin')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to restore this driver.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Driver $driver): Response
    {
        if($user->hasRole('admin')) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to permanently delete this driver.');
    }
}
