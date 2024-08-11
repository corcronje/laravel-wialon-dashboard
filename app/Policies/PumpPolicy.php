<?php

namespace App\Policies;

use App\Models\Pump;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PumpPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return Response::deny('You are not authorized to view pumps.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pump $pump): Response
    {
        return Response::deny('You are not authorized to view this pump.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to create pumps.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pump $pump): Response
    {
        if($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to update this pump.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pump $pump): Response
    {
        if($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to delete this pump.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pump $pump): Response
    {
        return Response::deny('You are not authorized to restore this pump.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pump $pump): Response
    {
        return Response::deny('You are not authorized to permanently delete this pump.');
    }
}
