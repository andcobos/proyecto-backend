<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Seller;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellerPolicy
{
    use HandlesAuthorization;

   
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    
    public function view(User $user, Seller $seller): bool
    {
        return $user->isAdmin() || $seller->user_id === $user->id;
    }

   
    public function create(User $user): bool
    {
        return !$user->isSeller() && !$user->seller;
    }

    
    public function approve(User $user): bool
    {
        return $user->isAdmin();
    }

    
    public function updateStatus(User $user): bool
    {
        return $user->isAdmin();
    }

    
    public function delete(User $user, Seller $seller): bool
    {
        return $user->isAdmin();
    }
}
