<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->isAdmin()){
            return  redirect()->route("admin.dashboard");
        }elseif($user->isRestaurantOwner()){

            if (!$user->restaurant) {
                // RO user existed in cerntral database but has no tenant

                Auth::logout();

                return redirect()->back()->with('error', __('You are not allowed to access this page'));
            }
            // TODO performance get first one 
            $id = $user->restaurant->run(function ($tenant) {
                return  RestaurantUser::whereHas('roles', function ($query) {
                        $query->where('name', 'Restaurant Owner');
                })->first()->id;
            });
            return redirect($user->restaurant->impersonationUrl($id,'dashboard'));
        }else {
            redirect()->route("home");
        }
    }
}
