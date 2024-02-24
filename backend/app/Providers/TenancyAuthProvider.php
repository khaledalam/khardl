<?php

namespace App\Providers;


use App\Models\Tenant\RestaurantUser;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class TenancyAuthProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if (env('APP_ENV') == 'testing') {
            if (env('TESTING_CENTRAL') == '1') {
                app('config')->set('auth.providers.users.model', User::class);
            } else {
                app('config')->set('auth.providers.users.model', RestaurantUser::class);
            }
        }else{
            if (request()->getHost() == config('tenancy.central_domains')[0]) {
                app('config')->set('auth.providers.users.model', User::class);
            } else {
                app('config')->set('auth.providers.users.model', RestaurantUser::class);
            }
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
