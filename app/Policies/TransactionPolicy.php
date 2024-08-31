<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransactionPolicy
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
    public function view(User $user, Transaction $transaction): Response
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

        return Response::deny('You do not have permission to create a transaction');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Transaction $transaction): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to update a transaction');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Transaction $transaction): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to delete a transaction');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Transaction $transaction): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to restore a transaction');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Transaction $transaction): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to permanently delete a transaction');
    }
}
