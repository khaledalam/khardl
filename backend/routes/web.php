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






Route::group(['middleware'=>['universal', InitializeTenancyByDomain::class],'as'=>'central.'],function() {
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
    Route::post('register', [\App\Http\Controllers\API\Auth\RegisterController::class, 'register'])->middleware('guest');
    Route::post('login', [\App\Http\Controllers\API\Auth\LoginController::class, 'login'])->middleware('guest');

    Route::post('password/forgot', [\App\Http\Controllers\API\Auth\ResetPasswordController::class, 'forgot']);
    Route::post('password/reset', [\App\Http\Controllers\API\Auth\ResetPasswordController::class, 'reset'])->middleware('throttle:passwordReset');

    Route::post('email/send-verify', [\App\Http\Controllers\API\Auth\RegisterController::class, 'sendVerificationCode'])->middleware('throttle:passwordReset');
    Route::post('email/verify', [\App\Http\Controllers\API\Auth\RegisterController::class, 'verify'])->middleware('throttle:passwordReset');

    Route::post('contact-us', [\App\Http\Controllers\API\ContactUsController::class, 'store']);

    Route::middleware(['auth:api', 'role:Restaurant Owner'])->group(function () {
        Route::post('register-step2', [\App\Http\Controllers\API\Auth\RegisterController::class, 'stepTwo']);
    });
    

})
->middleware(['universal', InitializeTenancyByDomain::class]);

Route::get('test', [\App\Http\Controllers\TestController::class, 'index']);

Route::middleware(['accepted'])->prefix('panel')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Panel\DashboardController::class, 'index'])->name('dashboard');
});
