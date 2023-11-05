<?php

use App\Traits\SharedRoutesTrait;
use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\Route;
use App\Traits\CentralSharedRoutesTrait;
use App\Http\Controllers\API\ContactUsController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\API\Auth\RegisterController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\API\Auth\ResetPasswordController;
use App\Http\Controllers\Central\AuthenticationController;

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


Route::group(['middleware' => ['universal', InitializeTenancyByDomain::class],'as'=>'central.'], static function() {
    $groups = CentralSharedRoutesTrait::groups();
    foreach ($groups as $group) {
        Route::middleware($group['middleware'])->group(function() use ($group){
            foreach ($group['routes'] as $route => $name) {
                Route::get($route, static function() {
                    return view('index');
                })->name($name);
            }
        });
    }

    // Note: moved outside gust middleware to prevent
    // ResponseHelper::response('User is already authenticated', ResponseHelper::HTTP_AUTHENTICATED);
    Route::post('auth-validation', [AuthenticationController::class, 'auth_validation'])->name('auth_validation');


    // Public
    Route::middleware('guest')->group(function () {

        Route::post('register', [RegisterController::class, 'register'])->name('register');
        Route::post('login', [LoginController::class, 'login'])->name('login');

        Route::post('password/forgot', [ResetPasswordController::class, 'forgot']);
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->middleware('throttle:passwordReset');

        Route::post('contact-us', [ContactUsController::class, 'store']);

    });

    // Auth Protected
    
    Route::middleware(['auth','notBlocked'])->group(function () {

        Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
        Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');



        Route::middleware('notVerified')->group(function () {

            Route::post('email/send-verify', [RegisterController::class, 'sendVerificationCode'])->middleware('throttle:passwordReset');
            Route::post('email/verify', [RegisterController::class, 'verify'])->middleware('throttle:passwordReset');

            Route::get('verification-email', static function() {
                return view("index");
            })->name("verification-email");
        });

        Route::middleware('verified')->group(function () {

            Route::middleware(['role:Restaurant Owner', 'notAccepted'])->group(function () {

                Route::get('complete-register', static function(){
                    return view("index");
                })->name("complete-register");
                Route::post('register-step2', [RegisterController::class, 'stepTwo']);
            });

            Route::middleware(['accepted'])->group(function () {
                Route::post('/create-tenant', [\App\Http\Controllers\Central\TenantController::class, 'store']);
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            });

        });
    });
});






// Route::get('test', [\App\Http\Controllers\TestController::class, 'index']);

