<?php

namespace App\Policies;

use App\Models\FuelDip;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FuelDipPolicy
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
    public function view(User $user, FuelDip $dip): Response
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

        return Response::deny('You do not have permission to create a fuel dip');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FuelDip $dip): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to update a fuel dip');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FuelDip $dip): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to delete a fuel dip');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FuelDip $dip): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to restore a fuel dip');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FuelDip $dip): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to permanently delete a fuel dip');
    }
}
