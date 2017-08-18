<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Sale'              => 'App\Policies\SalePolicy',
        'App\Models\User'              => 'App\Policies\UserPolicy',
        'App\Models\Company'           => 'App\Policies\CompanyPolicy',
        'App\Models\Product'           => 'App\Policies\ProductPolicy',
        'App\Models\Customer'          => 'App\Policies\CustomerPolicy',
        'App\Models\Purchase'          => 'App\Policies\PurchasePolicy',
        'App\Models\Supplier'          => 'App\Policies\SupplierPolicy',
        'Silber\Bouncer\Database\Role' => 'App\Policies\RolePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
