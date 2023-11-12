<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
   
     
    public function index()
    {
        $user = Auth::user();
        return match(true){
            $user->isAdmin() => redirect()->route("admin.dashboard"),
            $user->isRestaurantOwner() => redirect($user->restaurant->route('home')),
            default => redirect()->route("home")
        };
    }
}
