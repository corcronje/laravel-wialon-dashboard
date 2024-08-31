<?php

namespace App\Policies;

use App\Models\FuelAdjustment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FuelAdjustmentPolicy
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
    public function view(User $user, FuelAdjustment $adjustment): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to create a fuel adjustment');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FuelAdjustment $adjustment): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to update a fuel adjustment');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FuelAdjustment $adjustment): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to delete a fuel adjustment');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FuelAdjustment $adjustment): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to restore a fuel adjustment');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FuelAdjustment $adjustment): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to permanently delete a fuel adjustment');
    }
}
