<?php

namespace App\Http\Controllers\Web\Central\Auth;

use App\Http\Controllers\API\Central\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\BaseController;
use App\Models\Tenant;
use App\Models\Tenant\RestaurantUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email|min:10|max:255',
            'password' => 'required|string|min:6|max:255',
            'remember_me' => 'nullable|boolean',
            'login_code' => 'nullable|string|min:5|max:5',
        ]);

        if ($request->has('login_code') && $request->login_code) {
            $tenant = Tenant::whereJsonContains('data->mapper_hash', $request->login_code)->first();
            if (!$tenant) {
                return $this->sendError(__('Validation Error. R!'));
            }

            return $tenant->run(function () use($request) {
                return (new \App\Http\Controllers\API\Tenant\Auth\LoginController())->logout($request);
            });
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials,true)) {
            return $this->sendError('Unauthorized.', ['error' => __('Invalid email or password')]);
        }

        $user = Auth::user();
        if($user->isBlocked() ){
            Auth::logout();
            return $this->sendError('Unauthorized.', ['error' => __('blocked-user')]);
        }elseif(!$user->isActive()){
            $register = new RegisterController();
            $register->sendVerificationCode($request);
        }
        $user->force_logout = 0;

        if($user->restaurant){
            $user->restaurant->run(function ($tenant) {
                $RO =  RestaurantUser::first();

                if($RO){
                    $RO->force_logout = 0;
                    $RO->save();

                }
            });
        }
        $user->save();
        $data = [
            'user'=>$user
        ];

        if((!$user?->traderRegistrationRequirement && $user?->isRestaurantOwner())|| ($user?->isRestaurantOwner() && !$user?->restaurant)) {
            $data['step2_status'] = 'incomplete';
        } else {
            $data['step2_status'] = 'completed';
        }

        return $this->sendResponse($data, __('User logged in successfully.'));
    }


}
