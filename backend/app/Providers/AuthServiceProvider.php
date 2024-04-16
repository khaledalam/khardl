<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Tenant\RestaurantUser;
use App\Policies\DriverPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        RestaurantUser::class => DriverPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();


    }
    public function register(){

    }
}
