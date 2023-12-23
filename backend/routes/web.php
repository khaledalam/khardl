<?php

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Models\Tenant\RestaurantStyle;
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
use App\Http\Controllers\API\Central\Auth\ResetPasswordController;



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


 Route::get('/test', function (){

 })->name('test');

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
//         'token' => 'required',restaurants
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



Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');

//-----------------------------------------------------------------------------------------------------------------------
Route::group(['middleware' => ['universal', InitializeTenancyByDomain::class]], static function() {
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

        Route::post('contact-us', [ContactUsController::class, 'store']);

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
            });

            Route::middleware(['accepted'])->group(function () {
                Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
                Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>['admin']],function () {
                    Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('permission:can_access_dashboard')->name('dashboard');
                    Route::post('/approve/{id}', [AdminController::class, 'approveUser'])->middleware('permission:can_approve_restaurants')->name('approveUser');
                    Route::post('/deny/{id}', [AdminController::class, 'denyUser'])->middleware('permission:can_approve_restaurants')->name('denyUser');
                    Route::get('/add-user', [AdminController::class, 'addUser'])->middleware('permission:can_add_admins')->name('add-user');
                    Route::delete('/delete/{id}', [AdminController::class, 'deleteRestaurant'])->middleware('permission:can_delete_restaurants')->name('delete-restaurant');
                    Route::post('/generate-user', [AdminController::class, 'generateUser'])->middleware('permission:can_add_admins')->name('generate-user');
                    Route::get('/logs', [AdminController::class, 'logs'])->middleware('permission:can_see_logs')->name('log');
                    Route::get('/restaurants/{id}', [AdminController::class, 'viewRestaurant'])->middleware('permission:can_view_restaurants')->name('view-restaurants');
                    Route::get('/restaurants/{id}/orders', [AdminController::class, 'viewRestaurantOrders'])->middleware('permission:can_view_restaurants')->name('view-restaurants-orders');
                    Route::get('/restaurants/{id}/customers', [AdminController::class, 'viewRestaurantCustomers'])->middleware('permission:can_view_restaurants')->name('view-restaurants-customers');
                    Route::get('/restaurants', [AdminController::class, 'restaurants'])->middleware('permission:can_access_restaurants')->name('restaurants');
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

                    Route::get('/revenue', [AdminController::class, 'revenue'])->name('revenue');

                });

            });

        });
    });
    Route::get('/change-language/{locale}', function ($locale) {
        App::setLocale($locale);
        Session::put('locale', $locale);
        return Redirect::back();
    })->name('change.language');


    Route::get('/delivery-webhook', static function () {
        return response()->json([
            'status' => 'under construction',
            '_get' => $_GET,
        ]);

    })->name('delivery.webhook');

    Route::post('/delivery-webhook', static function () {
        return response()->json([
            'status' => 'under construction',
            '_post' => $_POST
        ]);

    })->name('delivery.webhook-post');

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

