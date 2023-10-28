<?php

use Illuminate\Support\Facades\Route;

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



$sharedRoutes = \App\Traits\SharedRoutesTrait::getSharedRoutes();
foreach ($sharedRoutes as $route) {
    Route::get($route, function() {
        return view('index');
    })->name($route);
}

Route::middleware(['accepted'])->prefix('panel')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Panel\DashboardController::class, 'index'])->name('dashboard');
});
