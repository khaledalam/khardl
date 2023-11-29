<?php

declare(strict_types=1);


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TapController;
use App\Traits\TenantSharedRoutesTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Stancl\Tenancy\Features\UserImpersonation;
use App\Http\Controllers\TenantAssetsController;
use App\Http\Controllers\API\Tenant\ItemController;
use App\Http\Controllers\API\Tenant\OrderController;
use App\Http\Controllers\API\Tenant\BranchController;
use App\Http\Controllers\API\Tenant\CategoryController;
use App\Http\Controllers\Web\Tenant\DashboardController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Web\Tenant\Auth\LoginController;
use App\Http\Controllers\Web\Tenant\RestaurantController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use App\Http\Controllers\API\Tenant\CustomerStyleController;
use App\Http\Controllers\Web\Tenant\Auth\RegisterController;
use App\Http\Controllers\Web\Tenant\AuthenticationController;
use App\Http\Controllers\API\Tenant\RestaurantStyleController;
use App\Http\Controllers\Web\Tenant\Auth\ResetPasswordController;
use App\Http\Controllers\API\Tenant\Auth\LoginController  as APILoginController;
use App\Packages\TapPayment\Controllers\BusinessController;
use App\Packages\TapPayment\Controllers\FileController;
use App\Packages\TapPayment\Controllers\SubscriptionController;

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
    'middleware' => ['tenant','web'],
], static function () {

    Route::get('/impersonate/{token}', static function ($token) {
        return UserImpersonation::makeResponse($token);
    })->name("impersonate");

    Route::get('login-trial', static function() {
        return view("tenant");
    })->name("login-trial")->middleware(['guest','restaurantNotLive']);
    Route::post('login', [LoginController::class, 'login'])->name('tenant_login');

    // guest
    Route::get('logout', [AuthenticationController::class, 'logout'])->name('tenant_logout_get');
    Route::post('logout', [AuthenticationController::class, 'logout'])->name('tenant_logout');

    Route::post('auth-validation', [AuthenticationController::class, 'auth_validation'])->name('auth_validation');

    Route::get('/restaurant-style', [RestaurantStyleController::class, 'fetch'])->name('restaurant.restaurant.style.fetch');

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

        Route::get('/customer-style', [CustomerStyleController::class, 'fetch'])->name('restaurant.customer.style.fetch');

        Route::middleware(['restaurantOrWorker'])->group(function () {
            Route::get('/profile', [RestaurantController::class, 'profile'])->name('restaurant.profile');
            Route::post('/profile', [RestaurantController::class, 'updateProfile'])->name('restaurant.profile-update');
            Route::get('/workers/{branchId}', [RestaurantController::class, 'workers'])->middleware('permission:can_modify_and_see_other_workers')->name('restaurant.workers');
            Route::get('/workers/add/{branchId}', [RestaurantController::class, 'addWorker'])->middleware('permission:can_modify_and_see_other_workers')->name('restaurant.get-workers');
            Route::post('/workers/add/{branchId}', [RestaurantController::class, 'generateWorker'])->middleware('permission:can_modify_and_see_other_workers')->name('restaurant.generate-worker');
            Route::put('/workers/update/{id}', [RestaurantController::class, 'updateWorker'])->middleware('permission:can_modify_and_see_other_workers')->name('restaurant.update-worker');
            Route::get('/workers/edit/{id}', [RestaurantController::class, 'editWorker'])->middleware('permission:can_modify_and_see_other_workers')->name('restaurant.edit-worker');
            Route::get('/branches-site-editor', [RestaurantController::class, 'branches_site_editor'])->name('restaurant.branches_site_editor');
            Route::get('/branches', [RestaurantController::class, 'branches'])->name('restaurant.branches');
            Route::put('/branches/{id}', [RestaurantController::class, 'updateBranch'])->middleware('permission:can_modify_working_time')->name('restaurant.update-branch');
            Route::get('/menu/{branchId}', [RestaurantController::class, 'menu'])->middleware('permission:can_edit_menu')->name('restaurant.menu');
            Route::get('/menu/{id}/{branchId}', [RestaurantController::class, 'getCategory'])->middleware('permission:can_edit_menu')->name('restaurant.get-category');
            Route::post('/category/add/{branchId}', [RestaurantController::class, 'addCategory'])->middleware('permission:can_edit_menu')->name('restaurant.add-category');
            Route::post('/category/{id}/{branchId}/add-item', [RestaurantController::class, 'addItem'])->middleware('permission:can_edit_menu')->name('restaurant.add-item');
            Route::delete('/category/{id}/delete-item', [RestaurantController::class, 'deleteItem'])->middleware('permission:can_edit_menu')->name('restaurant.delete-item');
            Route::delete('/category/delete/{id}', [RestaurantController::class, 'deleteCategory'])->middleware('permission:can_edit_menu')->name('restaurant.delete-category');
            Route::get('/payments', [TapController::class, 'payments'])->middleware('permission:can_control_payment')->name('tap.payments');
            Route::post('/payment', [TapController::class, 'payment'])->middleware('permission:can_control_payment')->name('tap.payment');
            Route::middleware('restaurant')->group(function () {

                // TAP Create Business
                // Step 1:
                Route::get('/payments/tap-create-business-upload-documents', [TapController::class, 'payments_upload_tap_documents_get'])->name('tap.payments_upload_tap_documents_get');
                Route::post('/payments/tap-create-business-upload-documents', [TapController::class, 'payments_upload_tap_documents'])->name('tap.payments_upload_tap_documents');

                // Step 2:
                Route::get('/payments/tap-create-business-submit-documents', [TapController::class, 'payments_submit_tap_documents_get'])->name('tap.payments_submit_tap_documents_get');
                Route::post('/payments/tap-create-business-submit-documents', [TapController::class, 'payments_submit_tap_documents'])->name('tap.payments_submit_tap_documents');

                Route::get('/summary', [RestaurantController::class, 'index'])->name('restaurant.summary');
                Route::get('/service', [RestaurantController::class, 'services'])->name('restaurant.service');
                Route::post('/branches/add', [RestaurantController::class, 'addBranch'])->name('restaurant.add-branch');
                Route::post('/branches/update-location/{id}', [RestaurantController::class, 'updateBranchLocation'])->name('restaurant.update-branch-location');
                Route::any('/callback',[TapController::class, 'callback'])->name('tap.callback');
                Route::delete('/workers/delete/{id}', [RestaurantController::class, 'deleteWorker'])->middleware('permission:can_modify_and_see_other_workers')->name('restaurant.delete-worker');

                Route::post('/restaurant-style', [RestaurantStyleController::class, 'save'])->name('restaurant.restaurant.style.save');
                Route::post('/customer-style', [CustomerStyleController::class, 'save'])->name('restaurant.customer.style.save');

                $group = TenantSharedRoutesTrait::getPrivateRoutes();
                Route::middleware($group['middleware'])->group(function() use ($group){
                    foreach ($group['routes'] as $route => $name) {
                        Route::get($route, static function(Request $request) {
                            return view('tenant');
                        })->name($name);
                    }
                });

            });
            Route::middleware('worker')->group(function () {

            });
        });


    });



    Route::group([
        'middleware' => ['restaurantLive'],
    ], static function () {
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

        Route::post('register', [RegisterController::class, 'register'])->name('tenant_register');

        Route::post('password/forgot', [ResetPasswordController::class, 'forgot']);
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->middleware('throttle:passwordReset');


        Route::middleware('auth')->group(function () {

            Route::middleware('notVerifiedPhone')->group(function () {
                Route::get('verification-phone', static function() {
                    return view("tenant");
                })->name("verification-phone");
                Route::post('phone/send-verify', [RegisterController::class, 'sendVerificationSMSCode']);
                Route::post('phone/verify', [RegisterController::class, 'verify']);
            });



            Route::middleware('verified')->group(function () {

            });


        });

        Route::get('categories',[CategoryController::class,'index']);

        Route::get('/tenancy/assets/{path?}', [TenantAssetsController::class,'asset'])
        ->where('path', '(.*)')
        ->name('stancl.tenancy.asset');
    });

    Route::get('/change-language/{locale}', static function ($locale) {
        App::setLocale($locale);
        Session::put('locale', $locale);
        return Redirect::back();
    })->name('change.language');

});

Route::prefix('api')->middleware([
    'api',
    'tenant'
])->group(function () {
    // API

    Route::post('login', [APILoginController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function(){
        Route::apiResource('categories',CategoryController::class)->only([
            'index'
        ]);
        Route::apiResource('orders',OrderController::class)->only([
            'index'
        ]);
        Route::put('orders/{order}/status',[OrderController::class,'updateStatus']);
        Route::put('items/{item}/availability',[ItemController::class,'updateAvailability']);
        Route::put('branches/{branch}/delivery',[BranchController::class,'updateDelivery']);
        Route::get('branches/{branch}/delivery',[BranchController::class,'getDeliveryAvailability']);
        Route::post('logout', [APILoginController::class, 'logout']);
    });
    Route::prefix('tap')->group(function(){
        Route::apiResource('businesses', BusinessController::class)->only([
            'store','show'
        ]);
        Route::apiResource('subscriptions', SubscriptionController::class)->only([
            'store','show'
        ]);
        Route::apiResource('files', FileController::class)->only([
            'store','show'
        ]);
        Route::apiResource('webhook-tap-actions','tap-payment');
    });



});
Route::group(['prefix' => config('sanctum.prefix', 'sanctum')], static function () {
    Route::get('/csrf-cookie', [CsrfCookieController::class, 'show'])
        ->middleware([
            'web',
            'universal',
            InitializeTenancyByDomain::class
        ])->name('sanctum.csrf-cookie');
});
