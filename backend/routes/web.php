<?php

use App\Traits\ResponseCode;
use App\Traits\SharedRoutesTrait;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\API\ContactUsController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\API\Auth\RegisterController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Central\AuthenticatedController;
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
    Route::post('auth-validation', [AuthenticatedController::class,'auth']);

    Route::post('register', [RegisterController::class, 'register'])->middleware('guest');
    Route::post('login', [LoginController::class, 'login'])->middleware('guest');
   
    Route::post('password/forgot', [ResetPasswordController::class, 'forgot']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->middleware('throttle:passwordReset');
           
    Route::middleware('auth')->group(function () {

      
        Route::middleware('notVerified')->group(function () {
            Route::post('email/send-verify', [RegisterController::class, 'sendVerificationCode'])->middleware('throttle:passwordReset');
            Route::post('email/verify', [RegisterController::class, 'verify'])->middleware('throttle:passwordReset');
      
            Route::get('verification-email',function(){
                return view("index");
            })->name("verification-email");
        });
        
        Route::middleware('verified')->group(function () {
          
            Route::middleware(['role:Restaurant Owner'])->group(function () {
                Route::get('complete-register',function(){
                    return view("index");
                })->name("complete-register");
                Route::post('register-step2', [RegisterController::class, 'stepTwo']);
            })->middleware('notAccepted');

            Route::middleware(['accepted'])->prefix('panel')->group(function () {
                
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            });
               
        });  
    });
    Route::post('contact-us', [ContactUsController::class, 'store']);

   

});

// Route::get('test', [\App\Http\Controllers\TestController::class, 'index']);

