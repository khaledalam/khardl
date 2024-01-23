<?php

namespace App\Http\Controllers\Web\Tenant\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Tenant\CustomerLoginRequest;
use App\Models\Tenant\RestaurantUser;

class LoginCustomerController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        dd("TEST");
//        $this->middleware('guest')->except('logout');
    }

    public function login(CustomerLoginRequest $request)
    {
        $user = RestaurantUser::where("phone",$request->phone)->first();
        $user->status = RestaurantUser::INACTIVE;
        $user->phone_verified_at = null;
        $user->save();
        Auth::loginUsingId($user->id,true);
        $user = Auth::user();

        $data = [
            'user'=>$user
        ];

        return $this->sendResponse($data, __('User logged in successfully.'));
    }
}
