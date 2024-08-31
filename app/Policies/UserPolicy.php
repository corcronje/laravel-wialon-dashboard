<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        if($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to view users.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): Response
    {
        if($user->isAdmin()) {
            return Response::allow();
        }

        return $user->id === $model->id
            ? Response::allow()
            : Response::deny('You are not authorized to view this user.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to create users.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): Response
    {
        if($user->isAdmin()) {
            return Response::allow();
        }

        return $user->id === $model->id
            ? Response::allow()
            : Response::deny('You are not authorized to update this user.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response
    {
        if($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to delete this user.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): Response
    {
        if($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to restore this user.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): Response
    {
        if($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You are not authorized to permanently delete this user.');
    }
}
