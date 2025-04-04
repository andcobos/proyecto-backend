<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use App\Policies\SellerPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
        Seller::class => SellerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Definir Gate personalizado para actualizar estado de una orden
        Gate::define('update-order-status', function (User $user, Order $order) {
            return app(OrderPolicy::class)->updateStatus($user, $order);
        });
        
        // Definir Gate personalizado para verificar a un vendedor
        Gate::define('verify-seller', function (User $user, Seller $seller) {
            return app(SellerPolicy::class)->verify($user, $seller);
        });
    }
}
