<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use App\Nova\Menu\NovaMenu;
use App\Nova\Menu\TenantMenu;
use App\Nova\Menu\CentralMenu;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::withoutNotificationCenter();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes(['tenant', 'universal'])
        ->withAuthenticationRoutes(['tenant', 'universal','nova'])
        ->withPasswordResetRoutes(['tenant', 'universal','nova'])
        ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
        });
    }
    protected function authorization(){
        if(tenancy()->initialized){
            Nova::auth(function ($request) {
                return $request->user()->hasRole('Restaurant Owner');
            });
        }else {
            Nova::auth(function ($request) {
                return $request->user()->isAdmin();
            });
        }
        
       
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        
        return [
            new \Badinansoft\LanguageSwitch\LanguageSwitch(),
            new \App\Nova\Menu\NovaMenu
        ];

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
