<?php

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Route::post('register', [RegisterController::class, 'register']);
// Route::post('login', [LoginController::class, 'login']);
//
//Route::post('password/forgot', [ResetPasswordController::class, 'forgot']);
//Route::post('password/reset', [ResetPasswordController::class, 'reset'])->middleware('throttle:passwordReset');
//
//Route::post('email/send-verify', [RegisterController::class, 'sendVerificationCode'])->middleware('throttle:passwordReset');
//Route::post('email/verify', [RegisterController::class, 'verify'])->middleware('throttle:passwordReset');
//
//Route::post('contact-us', [ContactUsController::class, 'store']);
//
//Route::middleware(['auth:api'])->group(function () { //role:Restaurant Owner
//    Route::post('register-step2', [RegisterController::class, 'stepTwo']);
//
//});
use App\Http\Controllers\MobileAppController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
//Route::post('auth-validation', [AuthenticationController::class, 'auth_validation'])->name('auth_validation');

Route::group(['middleware' => ['universal', 'trans_api', InitializeTenancyByDomain::class]], static function() {
    Route::get("/restaurants",[MobileAppController::class,'restaurants']);
});