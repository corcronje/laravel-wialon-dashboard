<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('You are not authorized to view orders.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Order $order): Response
    {
        return $user->id === $order->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to view this order.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('You are not authorized to create orders.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Order $order): Response
    {
        if($order->status === 'closed') {
            return Response::deny('This order has already been fulfilled.');
        }

        return $user->id === $order->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to update this order.');
    }

    /**
     * Determine whether the user can close the model.
     */
    public function close(User $user, Order $order): Response
    {
        if($order->status === 'closed') {
            return Response::deny('This order is already closed.');
        }

        return $user->id === $order->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to close this order.');
    }


    /**
     * Determine whether the user can fulfill the model.
     */
    public function fulfill(User $user, Order $order): Response
    {
        if($order->status === 'closed') {
            return Response::deny('This order has already been fulfilled.');
        }

        return $user->id === $order->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to fulfill this order.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Order $order): Response
    {
        if($order->status === 'closed') {
            return Response::deny('This order has already been fulfilled.');
        }

        return $user->id === $order->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to delete this order.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Order $order): Response
    {
        return $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('You are not authorized to restore this order.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Order $order): Response
    {
        return $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('You are not authorized to permanently delete this order.');
    }
}
