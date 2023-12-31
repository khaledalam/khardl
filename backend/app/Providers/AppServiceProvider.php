<?php

namespace App\Providers;

use App\Models\Setting as CentralSettings;
use App\Models\Tenant\Tap\TapBusiness;
use Illuminate\Http\Request;
use App\Repositories\PDF\OrderPDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PDF\PdfPrintInterface;
use App\Repositories\Customer\CartRepository;
use App\Repositories\PDF\CustomerPDF;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $this->app->bind(PdfPrintInterface::class,function(){
            $request =request()?->all();
            return match($request['type']){
                'order'=> new OrderPDF($request['tenant_id'],$request['id'] ?? null),
                'customer'=> new CustomerPDF($request['tenant_id'],$request['id'] ?? null),
                default =>  throw new ModelNotFoundException('')
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $user = Auth::user();
        View::share('link', request()->segment(1));
        View::share('admin_link', request()->segment(2));

        $settings = CentralSettings::first();
        $live_chat_enabled = $settings?->live_chat_enabled;

        View::share('live_chat_enabled', $live_chat_enabled);

        View::share('user', $user);
        Schema::defaultStringLength(250);

    }
}
