<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TapController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use App\Traits\CentralSharedRoutesTrait;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AdminController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\API\ContactUsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\API\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\API\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\API\Auth\ResetPasswordController as AuthResetPasswordController;


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


// Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::post('/logout', function(){
//     Auth::logout();
//     return redirect()->route('login')->with('success', 'You have been logged out.');
// })->middleware('auth')->name('logout');

// Route::group(['middleware' => ['guest']], function () {
//     Route::get('/register/{url}', [RegisterController::class, 'showRegisterForm'])->name('register.token');
// });

// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password');
// })->middleware('guest')->name('password.request');

// Route::post('/reset-password', function (Request $request) {
//     $request->validate([
//         'token' => 'required',
//         'email' => 'required|email',
//         'password' => 'required|min:8|confirmed',
//     ]);

//     $status = Password::reset(
//         $request->only('email', 'password', 'password_confirmation', 'token'),
//         function (User $user, string $password) {
//             $user->forceFill([
//                 'password' => Hash::make($password)
//             ])->setRememberToken(Str::random(60));

//             $user->save();

//             event(new PasswordReset($user));
//         }
//     );

//     return $status === Password::PASSWORD_RESET
//                 ? redirect()->route('login')->with('status', __($status))
//                 : back()->withErrors(['email' => [__($status)]]);
// })->middleware('guest')->name('password.update');

// Route::post('/forgot-password', function (Request $request) {
//     $request->validate(['email' => 'required|email']);

//     $status = Password::sendResetLink(
//         $request->only('email')
//     );

//     return $status === Password::RESET_LINK_SENT
//                 ? back()->with(['status' => __($status)])
//                 : back()->withErrors(['email' => __($status)]);
// })->middleware('guest')->name('password.email');


// Route::middleware('web')->group(function () {

//     Route::get('/email/verify', function () {
//         if (auth()->user()->email_verified_at !== null) {
//             return redirect('/summary'); // Redirect to a different route for already verified users
//         }
//         return view('auth.verify');
//     })->middleware('auth')->name('verification.notice');

//     Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//         if (auth()->user()->email_verified_at !== null) {
//             return redirect('/summary'); // Redirect to a different route for already verified users
//         }
//         $request->fulfill();
//         return redirect('/summary')->with('success', 'Verification successful. Good job!');

//     })->middleware(['auth', 'signed'])->name('verification.verify');

//     Route::post('/email/verification-notification', function (Request $request) {
//         if (auth()->user()->email_verified_at !== null) {
//             return redirect('/summary'); // Redirect to a different route for already verified users
//         }
//         $request->user()->sendEmailVerificationNotification();
//         return back()->with('message', 'Verification link sent!');
//     })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// });



// @TODO add central namespace
//-----------------------------------------------------------------------------------------------------------------------
Route::group(['middleware' => ['universal', InitializeTenancyByDomain::class]], static function() {
    $groups = CentralSharedRoutesTrait::groups();
    foreach ($groups as $group) {
        Route::middleware($group['middleware'])->group(function() use ($group){
            foreach ($group['routes'] as $route => $name) {
                Route::get($route, static function(Request $request) {
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

        Route::post('register', [AuthRegisterController::class, 'register'])->name('register');
        Route::post('login', [AuthLoginController::class, 'login'])->name('login');

        Route::post('password/forgot', [AuthResetPasswordController::class, 'forgot']);
        Route::post('password/reset', [AuthResetPasswordController::class, 'reset'])->middleware('throttle:passwordReset');

        Route::post('contact-us', [ContactUsController::class, 'store']);

    });

    // Auth Protected
    
    Route::middleware(['auth','notBlocked'])->group(function () {

        Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
        Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');



        Route::middleware('notVerified')->group(function () {

            Route::post('email/send-verify', [AuthRegisterController::class, 'sendVerificationCode'])->middleware('throttle:passwordReset');
            Route::post('email/verify', [AuthRegisterController::class, 'verify'])->middleware('throttle:passwordReset');

            Route::get('verification-email', static function() {
                return view("index");
            })->name("verification-email");
        });

        Route::middleware('verified')->group(function () {

            Route::middleware(['role:Restaurant Owner', 'notAccepted'])->group(function () {

                Route::get('complete-register', static function(){
                    return view("index");
                })->name("complete-register");
                Route::post('register-step2', [AuthRegisterController::class, 'stepTwo']);
            });

            Route::middleware(['accepted'])->group(function () {
                Route::post('/create-tenant', [\App\Http\Controllers\Central\TenantController::class, 'store']);
                Route::get('/dashboard', function(){
                    return route("restaurant.summary");
                })->name('dashboard');
            
                Route::middleware(['auth', 'verified', 'nonadmin', 'worker'])->group(function () {
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

                Route::middleware(['auth', 'verified', 'nonadmin', 'restaurant'])->group(function () {
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

                Route::prefix('admin')->middleware(['auth', 'admin', 'verified'])->group(function () {
                    Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('permission:can_access_dashboard')->name('admin.dashboard');
                    Route::get('/download-commercial-registration/{filename}', [AdminController::class, 'downloadCommercialRegistration'])->middleware('permission:can_view_restaurants')->name('download.commercial');
                    Route::get('/download-delivery-contract/{filename}', [AdminController::class, 'downloadDeliveryContract'])->middleware('permission:can_view_restaurants')->name('download.delivery');
                    Route::get('/download-tax-number/{filename}', [AdminController::class, 'downloadTaxNumber'])->middleware('permission:can_view_restaurants')->name('download.tax');
                    Route::get('/download-bank-certificate/{filename}', [AdminController::class, 'downloadBankCertificate'])->middleware('permission:can_view_restaurants')->name('download.bank');
                    Route::post('/approve/{id}', [AdminController::class, 'approveUser'])->middleware('permission:can_approve_restaurants')->name('admin.approveUser');
                    Route::post('/deny/{id}', [AdminController::class, 'denyUser'])->middleware('permission:can_approve_restaurants')->name('admin.denyUser');
                    Route::get('/add-user', [AdminController::class, 'addUser'])->middleware('permission:can_add_admins')->name('admin.add-user');
                    Route::delete('/delete/{id}', [AdminController::class, 'deleteRestaurant'])->middleware('permission:can_delete_restaurants')->name('admin.delete-restaurant');
                    Route::post('/generate-user', [AdminController::class, 'generateUser'])->middleware('permission:can_add_admins')->name('admin.generate-user');
                    Route::get('/logs', [AdminController::class, 'logs'])->middleware('permission:can_see_logs')->name('admin.log');
                    Route::get('/restaurants/{id}', [AdminController::class, 'viewRestaurant'])->middleware('permission:can_view_restaurants')->name('admin.view-restaurants');
                    Route::get('/restaurants/{id}/orders', [AdminController::class, 'viewRestaurantOrders'])->middleware('permission:can_view_restaurants')->name('admin.view-restaurants-orders');
                    Route::get('/restaurants', [AdminController::class, 'restaurants'])->middleware('permission:can_access_restaurants')->name('admin.restaurants');
                    Route::get('/settings', [AdminController::class, 'settings'])->middleware('permission:can_settings')->name('admin.settings');
                    Route::post('/promoters', [AdminController::class, 'addPromoter'])->middleware('permission:can_promoters')->name('admin.add-promoter');
                    Route::get('/promoters', [AdminController::class, 'promoters'])->middleware('permission:can_promoters')->name('admin.promoters');
                    Route::get('/user-management', [AdminController::class, 'userManagement'])->middleware('permission:can_see_admins')->name('admin.user-management');
                    Route::delete('/user-management/delete/{id}', [AdminController::class, 'deleteUser'])->middleware('permission:can_edit_admins')->name('admin.delete-user');
                    Route::delete('/promoters/delete/{id}', [AdminController::class, 'deletePromoter'])->middleware('permission:can_promoters')->name('admin.delete-promoter');
                    Route::get('/user-management/edit/{id}', [AdminController::class, 'userManagementEdit'])->middleware('permission:can_edit_admins')->name('admin.user-management-edit');
                    Route::put('/update-user-permissions/{userId}', [AdminController::class, 'updateUserPermissions'])->middleware('permission:can_edit_admins')->name('admin.update-user-permissions');
                    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
                    Route::get('/edit-profile', [AdminController::class, 'editProfile'])->middleware('permission:can_edit_profile')->name('admin.edit-profile');
                    Route::post('/profile', [AdminController::class, 'updateProfile'])->middleware('permission:can_edit_profile')->name('admin.profile-update');
                });

                Route::get('/change-language/{locale}', function ($locale) {
                    App::setLocale($locale);
                    Session::put('locale', $locale);
                    return Redirect::back();
                })->name('change.language');
    
            });

        });
    });
});
//-----------------------------------------------------------------------------------------------------------------------

// Old blade view
//Auth::routes();

// define auth routes manually
// Authentication Routes...
//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('/login', [LoginController::class, 'login']);
//Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//
//// Password Reset Routes...
//Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

