<?php

namespace App\Providers;

use Illuminate\Http\Request;
use App\Repositories\PDF\OrderPDF;
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
            $request =request()->all();
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
        
        View::share('link', request()->segment(1));
        View::share('admin_link', request()->segment(2));

    }
}
    