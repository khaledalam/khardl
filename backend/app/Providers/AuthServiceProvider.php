<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Bind Policies and Namespace for Tenant and Central
        $namespace = 'App\\Policies\\';
        Nova::serving(function (ServingNova $request)use(&$namespace) {
            if (tenancy()->initialized) {
                $namespace .= 'Tenant\\';
               Nova::resourcesIn(app_path('Nova/Tenant'));
            }
           else {
                Nova::resourcesIn(app_path('Nova/Central'));
            }
        });
        Gate::guessPolicyNamesUsing(function ($class) use (&$namespace) {
            return $namespace . class_basename($class) . 'Policy';
        });
    }
}
