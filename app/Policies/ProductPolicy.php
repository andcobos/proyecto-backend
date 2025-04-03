<?php

namespace App\Policies;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view any products.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('list-products');
    }

    /**
     * Determine whether the user can view the product.
     */
    public function view(User $user, Product $product): bool
    {
        return $user->can('read-product');
    }

    /**
     * Determine whether the user can create products.
     */
    public function create(User $user): bool
    {
        // Solo vendedores y admins pueden crear productos
        return $user->can('create-product');
    }

    /**
     * Determine whether the user can update the product.
     */
    public function update(User $user, Product $product): bool
    {
        // Solo el vendedor propietario o un admin puede actualizar el producto
        return $user->can('update-product') &&
            ($user->isAdmin() || $user->id == $product->seller->user_id);
    }

    /**
     * Determine whether the user can delete the product.
     */
    public function delete(User $user, Product $product): bool
    {
        // Solo el vendedor propietario o un admin puede eliminar el producto
        return $user->can('delete-product') &&
            ($user->isAdmin() || $user->id == $product->seller->user_id);
    }

}
