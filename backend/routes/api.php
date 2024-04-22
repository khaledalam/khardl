<?php

use App\Http\Controllers\API\Central\Auth\LoginCentralController;
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


use App\Http\Controllers\MobileAppController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

Route::group(['middleware' => ['universal', 'trans_api', InitializeTenancyByDomain::class]], static function() {
    Route::get("/restaurants",[MobileAppController::class,'restaurants']);


    Route::post("/login",[LoginCentralController::class,'login']);
    Route::post("/logout",[LoginCentralController::class,'logout']);
});
