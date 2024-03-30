<?php

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\CentralSetting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Models\Tenant\RestaurantStyle;
use App\Http\Controllers\TapController;
use Illuminate\Support\Facades\Session;
use App\Traits\CentralSharedRoutesTrait;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AdminController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\API\ContactUsController;
use App\Http\Controllers\AuthenticationController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Web\Central\Auth\LoginController;
use App\Http\Controllers\API\Central\Auth\RegisterController;
use App\Http\Controllers\Web\Central\Admin\Log\LogController;
use App\Http\Controllers\Web\Central\GlobalPromoterController;
use App\Http\Controllers\Web\Central\DeliveryWebhookController;
use App\Http\Controllers\API\Central\Auth\ResetPasswordController;
use App\Http\Controllers\Web\Central\Admin\Restaurant\RestaurantController;
use App\Http\Controllers\Web\Central\Admin\Dashboard\DashboardController as SuperAdminDashboard;

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

Route::get('/health', static function (){

    $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));

    $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
    $commitDate->setTimezone(new \DateTimeZone('Asia/Riyadh'));

    exec('git rev-parse --verify HEAD 2> /dev/null', $output);
    $hash = $output[0];

    exec("git show $hash", $git_message);
    $git_message_first_lines = [];
    $idx = 0;
    foreach ($git_message as $msg) {
        $git_message_first_lines[] = $msg;
        $idx++;
        if ($idx > 5) break;
    }


    return response()->json([
        'status' => 'ok',
        'last_commit_hash' => trim(exec('git log --pretty="%h" -n1 HEAD')),
        'last_commit_hashfull' => $hash,
        'last_commit_message' => $git_message_first_lines,
        'last_commit_url' => sprintf('https://github.com/mne-org/khardl/commit/%s', $commitHash),
        'last_commit_date' => sprintf('%s (timezone: Asia/Riyadh)', $commitDate->format('Y-m-d h:i:s A')),
        'mobile_app_orders_android_latest_versionCode' => 2,
        'mobile_app_orders_android_latest_versionName' => '1.3',
        'mobile_app_orders_android_force_update' => false,
        'mobile_app_orders_ios_latest_CURRENT_PROJECT_VERSION' => '1.6',
        'mobile_app_orders_ios_force_update' => false

    ]);
})->name('health');


 Route::get('/test', function (){
     return response()->json([
         'status' => 'test'
     ]);
 })->name('test');


Route::get('promoter/{name}', [GlobalPromoterController::class, 'show'])->name('global.promoter.show');
Route::get('promoters', [GlobalPromoterController::class, 'index'])->name('global.promoters');


Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::post('contact-us', [ContactUsController::class, 'store']);


//-----------------------------------------------------------------------------------------------------------------------
Route::group(['middleware' => ['universal', 'trans_api', InitializeTenancyByDomain::class]], static function() {
    $groups = CentralSharedRoutesTrait::groups();
    foreach ($groups as $group) {
        Route::middleware($group['middleware'])->group(function() use ($group){
            foreach ($group['routes'] as $route => $name) {
                Route::get($route, static function(Request $request) use ($route) {
                    if ($route === 'register') {
                        $promoter = $request->get('ref');
                        if ($promoter) {
                            RegisterController::increasePromotersEntered($promoter);
                        }
                    }
                    return view('central');
                })->name($name);
            }
        });
    }
    Route::post('auth-validation', [AuthenticationController::class, 'auth_validation'])->name('auth_validation');

    // Public
    Route::middleware('guest')->group(function () {

        Route::post('register', [RegisterController::class, 'register'])->name('register');
        Route::post('login', [LoginController::class, 'login'])->name('login');

        Route::post('password/forgot', [ResetPasswordController::class, 'forgot']);
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->middleware('throttle:passwordReset');

    });

    // Auth Protected

    Route::middleware(['auth','notBlocked'])->group(function () {


        Route::middleware('notVerified')->group(function () {

            Route::post('email/send-verify', [RegisterController::class, 'sendVerificationCode'])->middleware('throttle:passwordReset');
            Route::post('email/verify', [RegisterController::class, 'verify'])->middleware('throttle:passwordReset');

            Route::get('verification-email', static function() {
                return view("central");
            })->name("verification-email");
        });

        Route::middleware('verified')->group(function () {

            Route::middleware(['role:Restaurant Owner', 'notAccepted'])->group(function () {

            Route::get('complete-register', static function(){
                    return view("central");
                })->name("complete-register");

                Route::post('register-step2', [RegisterController::class, 'stepTwo']);

                Route::get('register-step2', [RegisterController::class, 'getStepTwoData']);

            });

            Route::middleware(['accepted'])->group(function () {
                Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
                Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>['admin']],function () {
                    Route::get('/dashboard', [SuperAdminDashboard::class, 'index'])->middleware('permission:can_access_dashboard')->name('dashboard');
                    Route::post('/approve/{id}', [AdminController::class, 'approveUser'])->middleware('permission:can_approve_restaurants')->name('approveUser');
                    Route::post('/deny/{id}', [AdminController::class, 'denyUser'])->middleware('permission:can_approve_restaurants')->name('denyUser');
                    Route::get('/add-user', [AdminController::class, 'addUser'])->middleware('permission:can_add_admins')->name('add-user');
                    Route::delete('/delete/{id}', [AdminController::class, 'deleteRestaurant'])->middleware('permission:can_delete_restaurants')->name('delete-restaurant');
                    Route::post('/generate-user', [AdminController::class, 'generateUser'])->middleware('permission:can_add_admins')->name('generate-user');
                    Route::get('/logs', [LogController::class, 'logs'])->middleware('permission:can_see_logs')->name('log');
                    Route::controller(RestaurantController::class)->group(function () {
                        Route::get('/restaurants/{tenant}','show')->middleware('permission:can_view_restaurants')->name('view-restaurants');
                        Route::patch('/restaurants/{tenant}/config','updateConfig')->middleware('permission:can_view_restaurants')->name('update-restaurants-config');
                        Route::get('/restaurants/{tenant}/tap/details','tapLead')->middleware('permission:can_view_restaurants')->name('view-restaurants-tap-lead');
                        Route::get('/restaurants','index')->middleware('permission:can_access_restaurants')->name('restaurants');
                        Route::post('/delivery/{tenant}', 'activeAndDeactivateDelivery')->name('delivery.activateAndDeactivate');
                        Route::post('/restaurants/{tenant}/payments/tap-create-lead', [TapController::class, 'payments_submit_lead'])->name('tap.sign-new-lead');

                      });
                    Route::post('/save-settings', [AdminController::class, 'saveSettings'])->middleware('permission:can_settings')->name('save-settings');
                    Route::get('/settings', [AdminController::class, 'settings'])->middleware('permission:can_settings')->name('settings');
                    Route::post('/promoters', [AdminController::class, 'addPromoter'])->middleware('permission:can_promoters')->name('add-promoter');
                    Route::get('/promoters', [AdminController::class, 'promoters'])->middleware('permission:can_promoters')->name('promoters');
                    Route::get('/user-management', [AdminController::class, 'userManagement'])->middleware('permission:can_see_admins')->name('user-management');
                    Route::get('/restaurant-owner-management', [AdminController::class, 'restaurantOwnerManagement'])->middleware('permission:can_see_restaurant_owners')->name('restaurant-owner-management');
                    Route::delete('/user-management/delete/{id}', [AdminController::class, 'deleteUser'])->middleware('permission:can_edit_admins')->name('delete-user');
                    Route::delete('/promoters/delete/{id}', [AdminController::class, 'deletePromoter'])->middleware('permission:can_promoters')->name('delete-promoter');
                    Route::get('/user-management/edit/{id}', [AdminController::class, 'userManagementEdit'])->middleware('permission:can_edit_admins')->name('user-management-edit');
                    Route::put('/update-user-permissions/{userId}', [AdminController::class, 'updateUserPermissions'])->middleware('permission:can_edit_admins')->name('update-user-permissions');
                    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
                    Route::get('/edit-profile', [AdminController::class, 'editProfile'])->middleware('permission:can_edit_profile')->name('edit-profile');
                    Route::post('/profile', [AdminController::class, 'updateProfile'])->middleware('permission:can_edit_profile')->name('profile-update');
                    Route::put('/restaurants/{restaurant}/activate', [AdminController::class, 'activateRestaurant'])->middleware('permission:can_approve_restaurants')->name('restaurant.activate');
                    Route::get('/download/file/{path}',[DownloadController::class,'download'])
                    ->where('path', '(.*)')
                    ->name("download.file");
                    Route::get('/download/pdf',[DownloadController::class,'downloadPDF'])
                    ->name("download.pdf");
                    Route::post('/toggle-status/{user}', [AdminController::class,'toggleStatus'])->middleware('permission:can_edit_admins')->name('toggle-status');

                    Route::controller(AdminController::class)->prefix('subscriptions')->group(function () {
                        Route::get('/', [AdminController::class, 'subscriptions'])->name('subscriptions');
                        Route::get('/create', [AdminController::class, 'subscriptionsCreate'])->name('subscriptions.create');
                        Route::post('/store', [AdminController::class, 'subscriptionsStore'])->name('subscriptions.store');
                        Route::get('/{subscription}/show', [AdminController::class, 'subscriptionShow'])->name('subscriptions.show');
                        Route::patch('/{subscription}/update', [AdminController::class, 'subscriptionUpdate'])->name('subscriptions.update');

                    });

                });

            });

        });
    });
    Route::get('/change-language/{locale}', function ($locale) {
        App::setLocale($locale);
        if(Auth::check()){
            $user = Auth::user();
            $user->update(['default_lang' => $locale]);
            $user?->restaurant?->run(function($tenant) use($user,$locale){
                $user = User::where('email',$user->email)->first();
                if($user){
                    $user->update(['default_lang' => $locale]);
                }
            });
        }
        Session::put('locale', $locale);
        return Redirect::back();
    })->name('change.language');

    Route::post('/delivery-webhook', [DeliveryWebhookController::class,'redirect'])->name('delivery.webhook-post');

});
//-----------------------------------------------------------------------------------------------------------------------
