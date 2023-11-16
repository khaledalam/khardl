<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Tenant\Auth\LoginController;
use App\Http\Controllers\Web\Tenant\Auth\RegisterController;
use App\Http\Controllers\Web\Tenant\Auth\ResetPasswordController;
use App\Http\Controllers\Web\Tenant\Auth\VerificationController;
use App\Http\Controllers\Web\Tenant\AuthenticationController;
use App\Http\Controllers\Web\Tenant\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TapController;
use App\Traits\TenantSharedRoutesTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\RestaurantController;
use App\Models\Tenant\Branch;
use App\Models\Tenant\RestaurantUser;
use Stancl\Tenancy\Features\UserImpersonation;

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


    // guest
    Route::get('logout', [AuthenticationController::class, 'logout'])->name('tenant_logout_get');
    Route::post('logout', [AuthenticationController::class, 'logout'])->name('tenant_logout');

    Route::post('register', [RegisterController::class, 'register'])->name('tenant_register');
    Route::post('login', [LoginController::class, 'login'])->name('tenant_login');

    Route::post('password/forgot', [ResetPasswordController::class, 'forgot']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->middleware('throttle:passwordReset');




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
            Route::post('email/send-verify', [VerificationController::class, 'sendVerificationCode'])->middleware('throttle:passwordReset');
            Route::post('email/verify', [VerificationController::class, 'verify'])->middleware('throttle:passwordReset');
        });


        Route::middleware('restaurantOrWorker')->group(function () {
            Route::get('/profile', [RestaurantController::class, 'profile'])->name('restaurant.profile');
            Route::post('/profile', [RestaurantController::class, 'updateProfile'])->name('restaurant.profile-update');
            Route::get('/workers/{branchId}', [RestaurantController::class, 'workers'])->middleware('permission:can_modify_and_see_other_workers')->name('restaurant.workers');
            Route::get('/workers/add/{branchId}', [RestaurantController::class, 'addWorker'])->middleware('permission:can_modify_and_see_other_workers')->name('restaurant.get-workers');
            Route::post('/workers/add/{branchId}', [RestaurantController::class, 'generateWorker'])->middleware('permission:can_modify_and_see_other_workers')->name('restaurant.generate-worker');
            Route::put('/workers/update/{id}', [RestaurantController::class, 'updateWorker'])->middleware('permission:can_modify_and_see_other_workers')->name('restaurant.update-worker');
            Route::get('/workers/edit/{id}', [RestaurantController::class, 'editWorker'])->middleware('permission:can_modify_and_see_other_workers')->name('restaurant.edit-worker');
            Route::get('/branches', [RestaurantController::class, 'branches'])->name('restaurant.branches');
            Route::put('/branches/{id}', [RestaurantController::class, 'updateBranch'])->middleware('permission:can_modify_working_time')->name('restaurant.update-branch');
            Route::get('/menu/{branchId}', [RestaurantController::class, 'menu'])->middleware('permission:can_edit_menu')->name('restaurant.menu');
            Route::get('/menu/{id}/{branchId}', [RestaurantController::class, 'getCategory'])->middleware('permission:can_edit_menu')->name('restaurant.get-category');
            Route::post('/category/add/{branchId}', [RestaurantController::class, 'addCategory'])->middleware('permission:can_edit_menu')->name('restaurant.add-category');
            Route::post('/category/{id}/{branchId}/add-item', [RestaurantController::class, 'addItem'])->middleware('permission:can_edit_menu')->name('restaurant.add-item');
            Route::delete('/category/{id}/delete-item', [RestaurantController::class, 'deleteItem'])->middleware('permission:can_edit_menu')->name('restaurant.delete-item');
            Route::delete('/category/delete/{id}', [RestaurantController::class, 'deleteCategory'])->middleware('permission:can_edit_menu')->name('restaurant.delete-category');
            Route::get('/payments', [TapController::class, 'payments'])->middleware('permission:can_control_payment')->name('tap.payments');
            Route::get('/payments/upload-tap-documents', [TapController::class, 'payments_upload_tap_documents_get'])->middleware('permission:can_control_payment')->name('tap.payments_upload_tap_documents_get');
            Route::post('/payments/upload-tap-documents', [TapController::class, 'payments_upload_tap_documents'])->middleware('permission:can_control_payment')->name('tap.payments_upload_tap_documents');
            Route::post('/payment', [TapController::class, 'payment'])->middleware('permission:can_control_payment')->name('tap.payment');
            Route::middleware('restaurant')->group(function () {
                Route::get('/summary', [RestaurantController::class, 'index'])->name('restaurant.summary');
                Route::post('/branches/add', [RestaurantController::class, 'addBranch'])->name('restaurant.add-branch');
                Route::post('/branches/update-location/{id}', [RestaurantController::class, 'updateBranchLocation'])->name('restaurant.update-branch-location');
                Route::any('/callback',[TapController::class, 'callback'])->name('tap.callback');
                Route::delete('/workers/delete/{id}', [RestaurantController::class, 'deleteWorker'])->middleware('permission:can_modify_and_see_other_workers')->name('restaurant.delete-worker');

            });
            Route::middleware('worker')->group(function () {

            });
        });



    });

    Route::get('/change-language/{locale}', static function ($locale) {

        App::setLocale($locale);
        Session::put('locale', $locale);
        return Redirect::back();
    })->name('change.language');
});
