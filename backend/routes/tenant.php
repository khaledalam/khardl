<?php

declare(strict_types=1);

use App\Models\Tenant\Branch;
use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Route;
use App\Traits\TenantSharedRoutesTrait;
use Stancl\Tenancy\Features\UserImpersonation;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::group([
    'middleware' => ['tenant',PreventAccessFromCentralDomains::class], 
    'as' => 'tenant.',
], function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id').
        ',<br> <strong><a href='.Nova::path().' >dashboard</a></strong>';
    })->name("home");
    $groups = TenantSharedRoutesTrait::groups();
    foreach ($groups as $group) {
        Route::middleware($group['middleware'])->group(function() use ($group){
            foreach ($group['routes'] as $route => $name) {
                Route::get($route, static function() {
                    return view('index');
                })->name($name);
            }
        });
    }
    Route::get('/impersonate/{token}', function ($token) {
        return UserImpersonation::makeResponse($token);
    })->name("impersonate");
});
