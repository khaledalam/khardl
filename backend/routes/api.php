<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [\App\Http\Controllers\API\Auth\RegisterController::class, 'register']);
Route::post('login', [\App\Http\Controllers\API\Auth\LoginController::class, 'login']);

Route::post('password/forgot', [\App\Http\Controllers\API\Auth\ResetPasswordController::class, 'forgot']);
Route::post('password/reset', [\App\Http\Controllers\API\Auth\ResetPasswordController::class, 'reset'])->middleware('throttle:passwordReset');

Route::post('email/send-verify', [\App\Http\Controllers\API\Auth\RegisterController::class, 'sendVerificationCode'])->middleware('throttle:passwordReset');
Route::post('email/verify', [\App\Http\Controllers\API\Auth\RegisterController::class, 'verify'])->middleware('throttle:passwordReset');

Route::post('contact-us', [\App\Http\Controllers\API\ContactUsController::class, 'store']);

Route::middleware(['auth:api', 'role:Restaurant Owner'])->group(function () {
    Route::post('register-step2', [\App\Http\Controllers\API\Auth\RegisterController::class, 'stepTwo']);
});
