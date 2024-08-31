<?php

namespace App\Policies;

use App\Models\Tank;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TankPolicy
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
    public function view(User $user, Tank $tank): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to create a tank.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tank $tank): Response
    {
        if($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to update a tank.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tank $tank): Response
    {
        if($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to delete a tank.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tank $tank): Response
    {
        if($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to restore a tank.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tank $tank): Response
    {
        return Response::deny('You are not authorized to permanently delete a tank.');
    }
}
