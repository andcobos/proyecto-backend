<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view any orders.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('list-orders');
    }

    /**
     * Determine whether the user can view the order.
     */
    public function view(User $user, Order $order): bool
    {
        // El usuario solo puede ver sus propias órdenes o las órdenes de sus productos (si es vendedor)
        if ($user->isAdmin()) {
            return true;
        }

        // Si el usuario es el comprador
        if ($order->user_id === $user->id) {
            return true;
        }

        // Si el usuario es el vendedor de la orden
        if ($order->seller_id && $user->isSeller() && $order->seller_id === $user->seller->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create orders.
     */
    public function create(User $user): bool
    {
        // Cualquier usuario autenticado puede crear órdenes
        return $user->can('create-order');
    }

    /**
     * Determine whether the user can update the order.
     */
    public function update(User $user, Order $order): bool
    {
        // Solo el admin puede actualizar órdenes completas
        return $user->isAdmin();
    }


    /**
     * Determine whether the user can update the status of an order.
     */
    public function updateStatus(User $user, Order $order): bool
    {
        // El admin siempre puede actualizar el estado
        if ($user->isAdmin()) {
            return true;
        }

        // El vendedor puede actualizar el estado de sus propias órdenes
        if ($user->isSeller() && $order->seller_id === $user->seller->id) {
            return $user->can('update-order-status');
        }

        return false;
    }

    /**
     * Determine whether the user can delete the order.
     */
    public function delete(User $user, Order $order): bool
    {
        // Solo el admin puede eliminar órdenes
        return $user->isAdmin() && $user->can('delete-order');
    }

}
