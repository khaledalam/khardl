<?php

namespace App\Providers;

use URL;
use App\Models\CentralSetting;
use App\Models\User;
use App\Repositories\PDF\OrderPDF;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Repositories\PDF\CustomerPDF;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PDF\PdfPrintInterface;
use App\Repositories\Customer\CartRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        if (env('APP_ENV') == 'local') {
//            config()->set('database.default', 'mysql_testing');
//        }

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
        Collection::macro('customPaginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator($this->forPage($page, $perPage), $total ?: $this->count(), $perPage, $page, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

//        echo config()->get('database.default',);
//        exit;
        // \URL::forceScheme('https');
        $user = Auth::user();
        View::share('link', request()->segment(1));
        View::share('admin_link', request()->segment(2));

        View::share('user', $user);
        Schema::defaultStringLength(250);

    }
}
