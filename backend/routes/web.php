<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/






Route::group(['middleware'=>'universal', InitializeTenancyByDomain::class,'as'=>'central.'],function() {
    $groups = \App\Traits\SharedRoutesTrait::groups();
    foreach ($groups as $group) {
        Route::middleware($group['middleware'])->group(function() use ($group){
            foreach ($group['routes'] as $route=>$name) {
                Route::get($route, function() {
                    return view('index');
                })->name($name);
            }
        });
    }
})
->middleware(['universal', InitializeTenancyByDomain::class]);

//Route::get('test', [\App\Http\Controllers\TestController::class, 'index'])->middleware("web");

Route::middleware(['accepted'])->prefix('panel')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Panel\DashboardController::class, 'index'])->name('dashboard');
});
