<?php

namespace App\Policies;

use App\Models\Attendant;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AttendantPolicy
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
    public function view(User $user, Attendant $attendant): Response
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

        return Response::deny('You are not authorized to create attendants.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Attendant $attendant): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to update this attendant.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Attendant $attendant): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to delete this attendant.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Attendant $attendant): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to restore this attendant.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Attendant $attendant): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to permanently delete this attendant.');
    }
}
