<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     
    public function index()
    {
        if(Auth::check()){
            $user = Auth::user();
            
            if ($user->role === 10) {
                return redirect('/admin/dashboard')->with('user', $user);
            }
            else if($user->role === 0){
                return view('restaurant.summary', compact('user'));
            }
            else{
                return redirect()->route('worker.branches')->with(compact('user'));
            }
        }
        else{
            return view('index');
        }
    }
}
