<?php

namespace App\Providers;

use App\Repositories\Customer\CartRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CartRepository::class,function(){
            return (new CartRepository)->initiate();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        View::share('link', request()->segment(1));
        View::share('admin_link', request()->segment(2));

    }
}
    