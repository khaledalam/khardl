<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return match(true){
            $user->isRestaurantOwner() => redirect()->route('restaurant.summary'),
            $user->isWorker() => redirect()->route('worker.profile'),
            default => view('tenant')
        };
    }
}
