<?php

declare(strict_types=1);


use App\Http\Controllers\API\Tenant\Customer\Address\CustomerAddressController;
use App\Http\Controllers\API\Tenant\LocationController;
use App\Http\Controllers\API\Tenant\Driver\Profile\ProfileController;

use App\Http\Controllers\API\Tenant\Notification\NotificationController;
use App\Http\Controllers\Notification\PushNotificationController;
use App\Http\Controllers\Web\Tenant\DeliveryCompanies\DeliveryCompaniesController;
use App\Http\Controllers\Web\Tenant\Driver\DriverController;
use App\Http\Controllers\Web\Tenant\OurServices\OurServicesController;
use App\Http\Controllers\Web\Tenant\QR\QRController;
use App\Http\Controllers\Web\Tenant\Setting\SettingController;
use App\Http\Controllers\Web\Tenant\Summary\SummaryController;
use App\Http\Controllers\Web\Tenant\Worker\WorkerController;
use App\Models\Tenant;
use App\Models\Tenant\RestaurantStyle;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TapController;
use App\Traits\TenantSharedRoutesTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Packages\TapPayment\Charge\Charge;
use App\Http\Controllers\DownloadController;
use Stancl\Tenancy\Features\UserImpersonation;
use App\Http\Controllers\TenantAssetsController;
use App\Http\Controllers\API\Tenant\ItemController;
use App\Http\Controllers\API\Tenant\OrderController;
use App\Http\Controllers\API\Tenant\BranchController;
use App\Http\Controllers\API\Tenant\CategoryController;
use App\Packages\TapPayment\Controllers\CardController;
use App\Packages\TapPayment\Controllers\FileController;
use App\Http\Controllers\Web\Tenant\DashboardController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Web\Tenant\Auth\LoginController;
use App\Http\Controllers\Web\Tenant\RestaurantController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use App\Packages\TapPayment\Controllers\BusinessController;
use App\Packages\TapPayment\Controllers\CustomerController;
use App\Http\Controllers\API\Tenant\Customer\CartController;
use App\Http\Controllers\API\Tenant\CustomerStyleController;
use App\Http\Controllers\Web\Tenant\Auth\RegisterController;
use App\Http\Controllers\Web\Tenant\Coupon\CouponController;
use App\Http\Controllers\Web\Tenant\AuthenticationController;
use App\Http\Controllers\API\Tenant\RestaurantStyleController;
use App\Packages\TapPayment\Controllers\SubscriptionController;
use App\Http\Controllers\Web\Tenant\Auth\LoginCustomerController;
use App\Http\Controllers\API\Central\Auth\ResetPasswordController;
use App\Http\Controllers\Web\Tenant\Customer\CustomerDataController;
use App\Http\Controllers\API\Tenant\Auth\LoginController as APILoginController;
use App\Http\Controllers\Web\Tenant\Order\OrderController as TenantOrderController;
use App\Http\Controllers\API\Tenant\Driver\Order\OrderController as DriverOrderController;
use App\Http\Controllers\API\Tenant\Customer\CardController as CustomerCardController;
use App\Http\Controllers\API\Tenant\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\API\Tenant\Customer\CouponController as CustomerCouponController;
use App\Http\Controllers\Web\Tenant\Menu\Item\ItemController as AdminItemController;

use App\Http\Controllers\API\Tenant\V2\Auth\V2_LoginController;

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

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok'
    ]);
})->name('health');

Route::get('/send-notification', [PushNotificationController::class, 'sendPushNotification']);


Route::group([
    'middleware' => ['tenant', 'web','trans_api'],
], static function () {

    Route::get('/impersonate/{token}', static function ($token) {
        // TODO  @todo improvement make custom response to remember user 
       UserImpersonation::makeResponse($token);
       if(Auth::user()?->isRestaurantOwner() || Auth::user()?->hasPermissionWorker('can_access_summary'))return redirect()->route('restaurant.summary');
       return redirect()->route('restaurant.branches');
    })->name("impersonate");

    Route::post('login-tenant', [LoginCustomerController::class, 'login'])->name('tenant_login');
//    Route::post('login-admins', [LoginController::class, 'login']);


    // guest
    Route::get('logout', [AuthenticationController::class, 'logout'])->name('tenant_logout_get');
    Route::post('logout', [AuthenticationController::class, 'logout'])->name('tenant_logout');

    Route::post('auth-validation', [AuthenticationController::class, 'auth_validation'])->name('auth_validation');

    TenantSharedRoutesTrait::run( TenantSharedRoutesTrait::successOrFail());
    TenantSharedRoutesTrait::run( TenantSharedRoutesTrait::NotLiveOrNotSubscribed());
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile-summary', [DashboardController::class, 'profile'])->name('profile-summary');
        Route::get('/customer-style', [CustomerStyleController::class, 'fetch'])->name('restaurant.customer.style.fetch');

        Route::middleware(['restaurantOrWorker','ActiveRestaurantAndBranch'])->group(function () {
            /* Summary page */
            Route::get('/summary', [SummaryController::class, 'index'])
            ->middleware('permission:can_access_summary')
            ->name('restaurant.summary');
            /* Summary page */
            /* Coupon page */
            Route::middleware('permission:can_access_coupons')
            ->resource('{branchId}/coupons',CouponController::class)
            ->withTrashed(['show','restore','edit','update']);
            Route::middleware('permission:can_access_coupons')
            ->name('coupons.')
            ->controller(CouponController::class)->group(function () {
                Route::delete('coupons/delete/{coupon}','delete')->withTrashed()->name('delete');
                Route::post('coupons/restore/{coupon}','restore')->withTrashed()->name('restore');
                Route::post('coupons/change-status/{coupon}','changeStatus')->withTrashed()->name('change-status');
            });
            /* Coupon page */
            /* QR page */
            Route::middleware('permission:can_access_qr')
            ->name('restaurant.')
            ->controller(QRController::class)->group(function () {
                Route::get('/qr', 'index')->name('qr');
                Route::post('/qr-create', 'create')->name('qr-create');
                Route::get('/qr-download/{id}', 'download')->name('qr-download');
            });
            /* QR page */
            /* Customer data page */
            Route::middleware('permission:can_access_customers_data')
            ->name('customers_data.')
            ->controller(CustomerDataController::class)->group(function () {
                Route::get('/customers-data', 'index')->name('list');
                Route::get('/customers-data/{restaurantUser}/edit', 'edit')->name('edit');
                Route::put('/customers-data/{restaurantUser}/edit', 'update')->name('update');
                Route::get('/customers-data/{restaurantUser}', 'show')->name('show');
                Route::put('/change-status/{restaurantUser}', 'update_status')->name('change-status');
            });
            /* Customer data page */
            /* Setting page */
            Route::middleware('permission:can_access_settings')
            ->name('restaurant.')
            ->controller(SettingController::class)->group(function () {
                Route::get('/settings', 'settings')->name('settings');
                Route::post('/update-settings', 'updateSettings')->name('update.settings');
            });
            /* Setting page */
            /* Delivery companies page */
            Route::middleware('permission:can_access_delivery_companies')
            ->name('restaurant.')
            ->controller(DeliveryCompaniesController::class)->group(function () {
                Route::get('/delivery', 'delivery')->name('delivery');
                Route::post('/delivery/{module}/activate','toggleActivation')->name('delivery.activate');
            });
            /* Delivery companies page */
            /* Our services page */
            Route::middleware('permission:can_access_service_page')
            ->name('restaurant.')
            ->controller(OurServicesController::class)->group(function () {
                Route::get('/service', 'services')->name('service');
                Route::patch('/service/deactivate', 'deactivate')->name('service.deactivate');
                Route::patch('/service/app/deactivate', 'appDeactivate')->name('service.app.deactivate');
                Route::patch('/service/activate', 'activate')->name('service.activate');
                Route::patch('/service/app/activate', 'appActivate')->name('service.app.activate');
                Route::get('/service/{type}/{number_of_branches}/calculate/{subscription_id}', 'calculate')->name('service.calculate');
                Route::get('/service/{coupon}/{type}/check/{number_of_branches?}', 'coupon')->name('service.coupon.check');
            });
            /* Our services page */
            /* Workers page */
            Route::middleware('permission:can_modify_and_see_other_workers')
            ->name('restaurant.')
            ->controller(WorkerController::class)->group(function () {
                Route::get('/workers/{branchId}', 'workers')->middleware('permission:can_modify_and_see_other_workers')->name('workers');
                Route::get('/workers/add/{branchId}', 'addWorker')->middleware('permission:can_modify_and_see_other_workers')->name('get-workers');
                Route::post('/workers/add/{branchId}', 'generateWorker')->middleware('permission:can_modify_and_see_other_workers')->name('generate-worker');
                Route::put('/workers/update/{id}', 'updateWorker')->middleware('permission:can_modify_and_see_other_workers')->name('update-worker');
                Route::get('/workers/edit/{id}', 'editWorker')->middleware('permission:can_modify_and_see_other_workers')->name('edit-worker');
            });
            /* Workers page */
            Route::get('/profile', [RestaurantController::class, 'profile'])->name('restaurant.profile');
            Route::post('/profile', [RestaurantController::class, 'updateProfile'])->name('restaurant.profile-update');

            Route::resource('drivers', DriverController::class)->middleware('permission:can_edit_and_view_drivers');
            Route::get('/branches-site-editor', [RestaurantController::class, 'branches_site_editor'])->name('restaurant.branches_site_editor');
            Route::get('/branches', [RestaurantController::class, 'branches'])->name('restaurant.branches');
            Route::put('/branches/{id}', [RestaurantController::class, 'updateBranch'])->middleware('permission:can_modify_working_time')->name('restaurant.update-branch');
            Route::put('/branches/{id}/update', [RestaurantController::class, 'updateBranchDetails'])->middleware('permission:can_modify_working_time')->name('restaurant.update-branch-details');
            Route::get('/branches/{id}/toggleBranch', [RestaurantController::class, 'toggleBranch'])->middleware('permission:can_modify_and_see_other_workers')->name('restaurant.update-branch-status');
            Route::get('/no_branches', [RestaurantController::class, 'noBranches'])->middleware('permission:can_edit_menu')->name('restaurant.no_branches');
//            Route::get('/menu/{branchId}', [RestaurantController::class, 'menu'])->middleware('permission:can_edit_menu')->name('restaurant.menu');
            Route::get('/menu/{id}/{branchId}', [RestaurantController::class, 'getCategory'])->middleware('permission:can_edit_menu')->name('restaurant.get-category');
            Route::post('/category/add/{branchId}', [RestaurantController::class, 'addCategory'])->middleware('permission:can_edit_menu')->name('restaurant.add-category');
            Route::post('/category/edit/{categoryId}/{branchId}', [RestaurantController::class, 'editCategory'])->middleware('permission:can_edit_menu')->name('restaurant.edit-category');
            Route::middleware('permission:can_edit_menu')->name('restaurant.')->controller(AdminItemController::class)->group(function () {
                Route::post('/category/{id}/{branchId}/add-item', 'store')->middleware('permission:can_edit_menu')->name('add-item');
                Route::post('/update-item/{item}', 'update')->middleware('permission:can_edit_menu')->name('update-item');
                Route::delete('/category/{id}/delete-item', 'delete')->middleware('permission:can_edit_menu')->name('delete-item');
                Route::get('/item/{item}', 'show')->middleware('permission:can_edit_menu')->name('view-item');
                Route::get('/item/{item}/edit', 'edit')->middleware('permission:can_edit_menu')->name('edit-item');

            });
            /* Start order routes */
            Route::middleware('permission:can_mange_orders')->controller(TenantOrderController::class)->group(function () {
//              Route::get('/order-inquiry', 'inquiry')->name('restaurant.order-inquiry');
                Route::get('orders-all', 'index')->name('restaurant.orders_all');
                Route::get('orders-add', 'create')->name('restaurant.orders_add');
                Route::post('orders-add', 'store')->name('restaurant.order.store');
                Route::get('search-products', 'searchProducts')->name('restaurant.search_products');
                Route::get('get-product-by-id/{item}', 'getProduct')->name('restaurant.getProduct');
                Route::post('change-availability/{item}', 'changeProductAvailability')->name('restaurant.change-availability');
            });
            /* End order routes */
            Route::delete('/category/delete/{id}', [RestaurantController::class, 'deleteCategory'])->middleware('permission:can_edit_menu')->name('restaurant.delete-category');
            Route::get('/payments', [TapController::class, 'payments'])->middleware(['permission:can_control_payment'])->name('tap.payments');
            Route::get('/download/pdf', [DownloadController::class, 'downloadPDF'])
                ->name("download.pdf");
            Route::group(['prefix' => '/branches'], function () {
                // Route::get('/{branch}',[RestaurantController::class, 'branch'])->name('restaurant.branch');
                Route::get('/orders/{order}', [RestaurantController::class, 'branchOrders'])->name('restaurant.branch.order');
                Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('restaurant.branch.order.status');
                Route::get('/orders/{status}/status', [OrderController::class, 'getStatus'])->name('restaurant.branch.order.getStatus');

                // Route::delete('/orders/{order}',[OrderController::class,'destroy'])->name('restaurant.branch.order.destroy');

            });

            Route::post('/branches/update-location/{id}', [RestaurantController::class, 'updateBranchLocation'])->name('restaurant.update-branch-location');
            Route::get('/promotions', [RestaurantController::class, 'promotions'])->name('restaurant.promotions')->middleware('permission:can_access_coupons');
            Route::post('/save-promotions', [RestaurantController::class, 'updatePromotions'])->name('promotions.save-settings')->middleware('permission:can_access_coupons');
            Route::post('/branches/{id}/toggleLoyaltyPoint', [RestaurantController::class, 'toggleLoyaltyPoint'])->name('restaurant.branch.toggleLoyaltyPoint')->middleware('permission:can_access_coupons');

            Route::middleware('restaurant')->group(function () {

                // TAP Create Business
                // Step 1: store files
                // Route::get('/payments/tap-create-business-upload-documents', [TapController::class, 'payments_upload_tap_documents_get'])->name('tap.payments_upload_tap_documents_get')->middleware('isBusinessSubmitted');
                // Route::post('/payments/tap-create-business-upload-documents', [TapController::class, 'payments_upload_tap_documents'])->name('tap.payments_upload_tap_documents')->middleware('isBusinessSubmitted');

                // // Step 2: create business
                // Route::get('/payments/tap-create-business-submit-documents', [TapController::class, 'payments_submit_tap_documents_get'])->name('tap.payments_submit_tap_documents_get')->middleware('isBusinessFilesSubmitted');
                // Route::post('/payments/tap-create-business-submit-documents', [TapController::class, 'payments_submit_tap_documents'])->name('tap.payments_submit_tap_documents')->middleware('isBusinessFilesSubmitted');

                // Step 2 instead of business : Lead
                // Route::get('/payments/tap-create-lead', [TapController::class, 'payments_submit_lead_get'])->name('tap.payments_submit_lead_get')->middleware('isLeadSubmitted');
                // Route::post('/payments/tap-create-lead', [TapController::class, 'payments_submit_lead'])->name('tap.payments_submit_lead')->middleware('isLeadSubmitted');
                // Step 3: save cards
                Route::post('/payments/tap-create-card-details', [TapController::class, 'payments_submit_card_details'])->name('tap.payments_submit_card_details');
                Route::post('/payments/tap-create-customer-app', [TapController::class, 'payments_submit_customer_app'])->name('tap.payments_submit_customer_app');

                Route::get('/payments/tap-card-details-redirect', [TapController::class, 'payments_redirect'])->name('tap.payments_redirect');
                Route::post('/payments/renew-branch', [TapController::class, 'renewBranch'])->name('tap.renewBranch');


                Route::post('/save-promotions', [RestaurantController::class, 'updatePromotions'])->name('promotions.save-settings')->middleware('permission:can_access_coupons');

                Route::get('branches/{branch}/settings', [RestaurantController::class, 'settingsBranch'])->name('restaurant.settings.branch');
                Route::put('branches/{branch}/settings', [RestaurantController::class, 'updateSettingsBranch'])->name('restaurant.settings.branch.update');



                Route::post('/branches/add', [RestaurantController::class, 'addBranch'])->name('restaurant.add-branch');
                Route::any('/callback', [TapController::class, 'callback'])->name('tap.callback');
                Route::delete('/workers/delete/{id}', [WorkerController::class, 'deleteWorker'])->middleware('permission:can_modify_and_see_other_workers')->name('restaurant.delete-worker');

                Route::post('/restaurant-style', [RestaurantStyleController::class, 'save'])->name('restaurant.restaurant.style.save');
                Route::post('/customer-style', [CustomerStyleController::class, 'save'])->name('restaurant.customer.style.save');

            });
        });
        TenantSharedRoutesTrait::run(TenantSharedRoutesTrait::siteEditor());

        Route::get('/download/file/{path?}', function ($path) {
            try {
                return response()->download(storage_path("app/public/$path"));
            } catch (Exception $e) {
                return redirect()->back()->with('error', __('File not exists !'));
            }

        })
            ->where('path', '(.*)')
            ->name("download.file");

    });



    Route::group([
        'middleware' => ['restaurantLive','restaurantSubLive'],
    ], static function () {

        $groups = TenantSharedRoutesTrait::groups();
        foreach ($groups as $group) {
            TenantSharedRoutesTrait::run($group);
        }

        Route::get('/restaurant-style', [RestaurantStyleController::class, 'fetch'])->name('restaurant.restaurant.style.fetch');
        Route::get('/cart', static function () {
            $logo = RestaurantStyle::first()?->logo;
            $restaurant_name = Setting::first()->restaurant_name;

            return view('tenant', compact('logo', 'restaurant_name'));
        })->name('cart');


        Route::post('register-tenant', [RegisterController::class, 'register'])->name('tenant_register');

        Route::post('password/forgot', [ResetPasswordController::class, 'forgot']);
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->middleware('throttle:passwordReset');

        Route::post('phone/send-verify', [LoginCustomerController::class, 'sendSMS']);
//         Route::post('phone/verify', [RegisterController::class, 'verify']);

        Route::middleware('auth')->group(function () {


            Route::post('/latlng-to-address', [LocationController::class, 'convertLatLngToAddress'])
                ->name('global.convertLatLngToAddress');





            Route::get('/user', [CustomerOrderController::class, 'user'])->name('customer.user');
            Route::post('/user', [CustomerOrderController::class, 'updateUser'])->name('customer.save.user');


            Route::middleware('verifiedPhone')->group(function () {
                /* Start Cart Route */
                Route::resource("carts", CartController::class)->only([
                    'index',
                    'store',
                    'destroy',
                    'update'
                ]);
                Route::controller(CartController::class)
                ->name('carts.')
                ->group(function () {
                    Route::delete("trash/carts", 'trash')->name('trash');
                    Route::get("carts/count", 'count')->name('count');
                });
                /* End Cart Route */
                Route::post("orders/validate", [CustomerOrderController::class, 'validateOrder'])->name('orders.validate');
                Route::post("orders/payment/redirect", [CustomerOrderController::class, 'paymentRedirect'])->name('orders.payment.redirect');
                Route::get("orders/payment/response", [CustomerOrderController::class, 'paymentResponse'])->name('orders.payment.response');

                Route::resource("orders", CustomerOrderController::class)->only([
                    'store',
                    'index'
                ]);
                Route::post("validate/coupon", [CustomerCouponController::class,'validateCoupon']);
                Route::post("remove/coupon", [CustomerCouponController::class,'removeCoupon']);
                Route::get("cards", [CustomerCardController::class, 'show'])->name('customer.cards');
                /* Customer address */
                Route::controller(CustomerAddressController::class)->group(function () {
                    Route::post('add-address','create');
                    Route::post('update-address/{address}','update');
                    Route::post('make-as-default/{address}','makeDefault');
                    Route::post('delete-address/{address}','delete');
                    Route::get('get-addresses','index');
                    Route::get('get-default','getDefault');
                });
                /* Customer address */
                Route::delete("cards/{card_id}/delete", [CustomerCardController::class, 'delete']);
            });


        });
        // TODO @todo prevent to access it from the website
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('orders', [OrderController::class, 'index']);


    });

    Route::get('/change-language/{locale}', static function ($locale) {
        App::setLocale($locale);
        if(Auth::check()){
            $user = Auth::user();
            $user->update(['default_lang' => $locale]);
            tenancy()->central(function ($tenant) use ($user,$locale) {
                $user = User::where('email',$user->email)->first();
                if($user){
                    $user->update(['default_lang' => $locale]);
                }
            });
        }
        Session::put('locale', $locale);
        return Redirect::back();
    })->name('change.language');

    Route::get('/tenancy/assets/{path?}', [TenantAssetsController::class, 'asset'])
    ->where('path', '(.*)')
    ->name('stancl.tenancy.asset');
});
Route::middleware([
    'api',
    'tenant',
    "trans_api"
])->group(function () {

    // route name webhook-client-delivery-companies
    Route::webhooks('delivery-webhook', 'delivery-companies');
    // route name  webhook-client-tap-payment
    Route::webhooks('webhook-tap-actions', 'tap-payment');

    // API
    Route::prefix('api')->group(function () {

        // New API endpoints to be placed here
        Route::prefix('v2')->group(static function () {

            // example:
            Route::post('logout', [V2_LoginController::class, 'logout']);


        });
        Route::post('login', [APILoginController::class, 'login']);

        Route::middleware(['auth:sanctum','ActiveRestaurantAndBranch'])->group(function () {
            //Notifications
            //External notification (Push)
            Route::post('save-token',[PushNotificationController::class,'saveToken']);
            Route::post('test-push-notification',[PushNotificationController::class,'testPushNotification']);
            //Internal notification
            Route::prefix('notifications')->group(function () {
                Route::controller(NotificationController::class)->group(function () {
                    Route::get('get-all', 'index');
                    Route::post('/read-notification/{id}','show');
                    Route::post('/unread-notification/{id}','unread');
                    Route::post('/read-all','markAllAsRead');
                    Route::post('/unread-all','markAllAsUnRead');
                });
                Route::controller(ProfileController::class)->group(function () {
                    Route::post('change-password', 'changePassword');
                });
            });
            Route::post('change-language',[\App\Http\Controllers\API\Tenant\Profile\ProfileController::class,'changeLang']);
            Route::apiResource('categories', CategoryController::class)->only([
                'index'
            ]);
            Route::apiResource('orders', OrderController::class)->only([
                'index'
            ]);
            Route::get('orders/{order}/logs', [OrderController::class, 'logs']);

            Route::put('orders/{order}/status', [OrderController::class, 'updateStatus']);
            Route::put('items/{item}/availability', [ItemController::class, 'updateAvailability']);
            Route::put('branches/{branch}/delivery', [BranchController::class, 'updateDelivery']);
            Route::get('branches/{branch}/delivery', [BranchController::class, 'getDeliveryAvailability']);
            Route::post('logout', [APILoginController::class, 'logout']);
            Route::middleware('driver')->group(function () {
                Route::prefix('driver')->group(function () {
                    Route::controller(DriverOrderController::class)->group(function () {
                        Route::get('drivers-orders', 'index')->name('drivers.all');
                        Route::get('drivers-calendar', 'history')->name('history');
                        Route::get('order-details/{order}', 'orderDetails')->name('order-details');
                        Route::post('change-status/{order}', 'changeStatus')->name('changeStatus');
                        Route::post('assign-order/{order}', 'assignOrder')->name('assign_order');
                    });
                    Route::controller(ProfileController::class)->group(function () {
                        Route::post('change-password', 'changePassword');
                        Route::get('get-profile', 'getProfile');
                        Route::post('update-image', 'updateImage');
                    });
                });
            });
        });
        // Update user in customer app
        Route::prefix('customer')->group(function () {
            Route::post('/login', [LoginCustomerController::class, 'loginCustomerOnly']);
            Route::post('/register', [LoginCustomerController::class, 'registerCustomerOnly']);
            Route::get('/restaurant-style-app', [RestaurantStyleController::class, 'fetchToApp'])->name('restaurant.restaurant.style.app');
            Route::post('/send/sms', [LoginCustomerController::class, 'sendSMS']);
            Route::get('/branches', [BranchController::class, 'index']);
            Route::get('/branches/{branch_id}/categories', [BranchController::class, 'categories']);

            Route::middleware(['auth:sanctum','customer'])->group(function () {
                Route::get('/', [CustomerOrderController::class, 'user']);
                Route::post('/update', [LoginCustomerController::class, 'updateCustomerApp']);
                Route::post('/verify/phone', [LoginCustomerController::class, 'VerifyCustomerPhone']);
                Route::get('/orders', [CustomerDataController::class, 'orders']);
                /* Customer address */
                Route::controller(CustomerAddressController::class)->group(function () {
                    Route::post('add-address','create');
                    Route::post('update-address/{address}','update');
                    Route::post('make-as-default/{address}','makeDefault');
                    Route::post('delete-address/{address}','delete');
                    Route::get('get-addresses','index');
                    Route::get('get-default','getDefault');
                });
                /* Customer address */
                Route::get("/cards", [CustomerCardController::class, 'show']);
            });
        });


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
// URL::forceScheme('https');
