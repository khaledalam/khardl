<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class TenancyAuthProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if(request()->getHost() == config('tenancy.central_domains')[0]){
            app('config')->set('auth.providers.users.model',\App\Models\User::class);
        }else {
            app('config')->set('auth.providers.users.model', \App\Models\Tenant\User::class);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
