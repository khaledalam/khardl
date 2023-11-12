<?php

declare(strict_types=1);

use App\Models\Tenant\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TapController;
use App\Traits\TenantSharedRoutesTrait;
use Illuminate\Support\Facades\Session;
use App\Traits\CentralSharedRoutesTrait;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\RestaurantController;
use Stancl\Tenancy\Features\UserImpersonation;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\AuthenticationController;

use App\Http\Controllers\API\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\API\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\API\Auth\ResetPasswordController as AuthResetPasswordController;
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
    'middleware' => ['tenant'],
],function () {
    $groups = TenantSharedRoutesTrait::groups();
    foreach ($groups as $group) {
        Route::middleware($group['middleware'])->group(function() use ($group){
            foreach ($group['routes'] as $route => $name) {
                Route::get($route, static function(Request $request) {
                    return view('tenant');
                })->name($name);
            }
        });
    }
    Route::middleware('guest')->group(function () {

        Route::post('register', [AuthRegisterController::class, 'register'])->name('register');
        Route::post('login', [AuthLoginController::class, 'login'])->name('login');

        Route::post('password/forgot', [AuthResetPasswordController::class, 'forgot']);
        Route::post('password/reset', [AuthResetPasswordController::class, 'reset'])->middleware('throttle:passwordReset');


    });
    Route::get('/impersonate/{token}', function ($token) {
        return UserImpersonation::makeResponse($token);
    })->name("impersonate");
    Route::post('auth-validation', [AuthenticationController::class, 'auth_validation'])->name('auth_validation');
 

    Route::middleware('auth')->group(function () { 
        Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

        Route::middleware('notVerified')->group(function () {
            Route::get('verification-email', static function() {
                return view("tenant");
            })->name("verification-email");
            Route::post('email/send-verify', [AuthRegisterController::class, 'sendVerificationCode'])->middleware('throttle:passwordReset');
            Route::post('email/verify', [AuthRegisterController::class, 'verify'])->middleware('throttle:passwordReset');
        });

        Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
        Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');

        Route::middleware('worker')->group(function () {
            Route::get('/worker/menu/{branchId}', [RestaurantController::class, 'menu'])->name('worker.menu');
            Route::get('/worker/branches', [WorkerController::class, 'branches'])->name('worker.branches');
            Route::put('/worker/branches/{id}', [RestaurantController::class, 'updateBranch'])->name('worker.update-branch');
            Route::get('/worker/menu/{id}/{branchId}', [RestaurantController::class, 'getCategory'])->name('worker.get-category');
            Route::post('/worker/category/add/{branchId}', [RestaurantController::class, 'addCategory'])->name('worker.add-category');
            Route::post('/worker/category/{id}/{branchId}/add-item', [RestaurantController::class, 'addItem'])->name('worker.add-item');
            Route::delete('/worker/category/{id}/delete-item', [RestaurantController::class, 'deleteItem'])->name('worker.delete-item');
            Route::delete('/worker/category/delete/{id}', [RestaurantController::class, 'deleteCategory'])->name('worker.delete-category');
            Route::get('/worker/workers/{branchId}', [RestaurantController::class, 'workers'])->name('worker.workers');
            Route::get('/worker/workers/add/{branchId}', [RestaurantController::class, 'addWorker'])->name('worker.get-workers');
            Route::post('/worker/workers/add/{branchId}', [RestaurantController::class, 'generateWorker'])->name('worker.generate-worker');
            Route::delete('/worker/workers/delete/{id}', [RestaurantController::class, 'deleteWorker'])->name('worker.delete-worker');
            Route::put('/worker/workers/update/{id}', [RestaurantController::class, 'updateWorker'])->name('worker.update-worker');
            Route::get('/worker/workers/edit/{id}', [RestaurantController::class, 'editWorker'])->name('worker.edit-worker');
            Route::get('/worker/profile', [RestaurantController::class, 'profile'])->name('worker.profile');
        });

        Route::middleware('restaurant')->group(function () { 
            Route::get('/summary', [RestaurantController::class, 'index'])->name('restaurant.summary');
            Route::get('/menu/{branchId}', [RestaurantController::class, 'menu'])->name('restaurant.menu');
            Route::get('/branches', [RestaurantController::class, 'branches'])->name('restaurant.branches');
            Route::post('/branches/add', [RestaurantController::class, 'addBranch'])->name('restaurant.add-branch');
            Route::put('/branches/{id}', [RestaurantController::class, 'updateBranch'])->name('restaurant.update-branch');
            Route::post('/branches/update-location/{id}', [RestaurantController::class, 'updateBranchLocation'])->name('restaurant.update-branch-location');
            Route::get('/menu/{id}/{branchId}', [RestaurantController::class, 'getCategory'])->name('restaurant.get-category');
            Route::post('/category/add/{branchId}', [RestaurantController::class, 'addCategory'])->name('restaurant.add-category');
            Route::post('/category/{id}/{branchId}/add-item', [RestaurantController::class, 'addItem'])->name('restaurant.add-item');
            Route::delete('/category/{id}/delete-item', [RestaurantController::class, 'deleteItem'])->name('restaurant.delete-item');
            Route::delete('/category/delete/{id}', [RestaurantController::class, 'deleteCategory'])->name('restaurant.delete-category');
            Route::get('/workers/{branchId}', [RestaurantController::class, 'workers'])->name('restaurant.workers');
            Route::get('/workers/add/{branchId}', [RestaurantController::class, 'addWorker'])->name('restaurant.get-workers');
            Route::post('/workers/add/{branchId}', [RestaurantController::class, 'generateWorker'])->name('restaurant.generate-worker');
            Route::delete('/workers/delete/{id}', [RestaurantController::class, 'deleteWorker'])->name('restaurant.delete-worker');
            Route::put('/workers/update/{id}', [RestaurantController::class, 'updateWorker'])->name('restaurant.update-worker');
            Route::get('/workers/edit/{id}', [RestaurantController::class, 'editWorker'])->name('restaurant.edit-worker');
            Route::get('/profile', [RestaurantController::class, 'profile'])->name('restaurant.profile');
            Route::post('/profile', [RestaurantController::class, 'updateProfile'])->name('restaurant.profile-update');
            Route::get('/points', [RestaurantController::class, 'points'])->name('tap.form');
            Route::post('/payment', [TapController::class,'payment'])->name('tap.payment');
            Route::any('/callback',[TapController::class,'callback'])->name('tap.callback');
        });
    });

    Route::get('/change-language/{locale}', function ($locale) {

        App::setLocale($locale);
        Session::put('locale', $locale);
        return Redirect::back();
    })->name('change.language');
});
