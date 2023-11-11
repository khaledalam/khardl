<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Traits\CentralSharedRoutesTrait;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\API\ContactUsController;
use App\Http\Controllers\AuthenticationController;
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


// Route::get('/home', [DashboardController::class, 'index'])->name('home');

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
                    return view('central');
                })->name($name);
            }
        });
    }
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
                Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
                Route::prefix('admin')->middleware('admin')->group(function () {
                    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
                    Route::get('/download-commercial-registration/{filename}', [AdminController::class, 'downloadCommercialRegistration'])->name('download.commercial');
                    Route::get('/download-delivery-contract/{filename}', [AdminController::class, 'downloadDeliveryContract'])->name('download.delivery');
                    Route::get('/download-tax-number/{filename}', [AdminController::class, 'downloadTaxNumber'])->name('download.tax');
                    Route::get('/download-bank-certificate/{filename}', [AdminController::class, 'downloadBankCertificate'])->name('download.bank');
                    Route::post('/approve/{id}', [AdminController::class, 'approveUser'])->name('admin.approveUser');
                    Route::post('/deny/{id}', [AdminController::class, 'denyUser'])->name('admin.denyUser');
                    Route::get('/add-user', [AdminController::class, 'addUser'])->name('admin.add-user');
                    Route::delete('/delete/{id}', [AdminController::class, 'deleteRestaurant'])->name('admin.delete-restaurant');
                    Route::post('/generate-user', [AdminController::class, 'generateUser'])->name('admin.generate-user');
                    Route::get('/logs', [AdminController::class, 'logs'])->name('admin.log');
                    Route::get('/restaurants/{id}', [AdminController::class, 'viewRestaurant'])->name('admin.view-restaurants');
                    Route::get('/restaurants/{id}/orders', [AdminController::class, 'viewRestaurantOrders'])->name('admin.view-restaurants-orders');
                    Route::get('/restaurants', [AdminController::class, 'restaurants'])->name('admin.restaurants');
                    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
                    Route::post('/promoters', [AdminController::class, 'addPromoter'])->name('admin.add-promoter');
                    Route::get('/promoters', [AdminController::class, 'promoters'])->name('admin.promoters');
                    Route::get('/user-management', [AdminController::class, 'userManagement'])->name('admin.user-management');
                    Route::delete('/user-management/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
                    Route::delete('/promoters/delete/{id}', [AdminController::class, 'deletePromoter'])->name('admin.delete-promoter');
                    Route::get('/user-management/edit/{id}', [AdminController::class, 'userManagementEdit'])->name('admin.user-management-edit');
                    Route::put('/update-user-permissions/{userId}', [AdminController::class, 'updateUserPermissions'])->name('admin.update-user-permissions');
                    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
                    Route::get('/edit-profile', [AdminController::class, 'editProfile'])->name('admin.edit-profile');
                    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('admin.profile-update');
                });

            });

        });
    });
    Route::get('/change-language/{locale}', function ($locale) {
        App::setLocale($locale);
        Session::put('locale', $locale);
        return Redirect::back();
    })->name('change.language');
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

