<?php

namespace App\Http\Controllers\Web\Central\Auth;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\ROSubscription;
use App\Models\Tenant\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\API\Central\Auth\RegisterController;
use Illuminate\Auth\EloquentUserProvider;

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

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|min:10|max:255',
            'password' => 'required|string|min:6|max:255',
            'remember_me' => 'nullable|boolean',
        ]);

        $credentials = request(['email', 'password']);

        
        if (!Auth::attempt($credentials,true)) {
            if ($request->has('login_code') && $request->login_code){
                $tenant = Tenant::whereJsonContains('data->mapper_hash', $request->login_code)->first();
                if (!$tenant) {
                    return $this->sendError(__('Validation Error. R!'));
                }
                return $tenant->run(function () use($credentials,$tenant) {
                    if(!Setting::first()?->is_live || ROSubscription::first()?->status != ROSubscription::ACTIVE){
                        return $this->sendError(__("Website doesn't have active subscription, Only restaurant owner can login"));
                    }
                    // switch to another guard
                    Auth::forgetGuards();
                    app('config')->set('auth.providers.users.model', RestaurantUser::class);

                    if (!Auth::attempt($credentials,true)) {
                        return $this->sendError(__('Invalid email or password'), ['error' => __('Invalid email or password')]);
                    } else {
                        $user = Auth::user();
                        
                        if(!$user->isWorker()){
                            Auth::logout();
                            return $this->sendError(__('Only worker can access this restaurant'));
                        }
                        if(!$user->branch?->active){
                            Auth::logout();
                            return $this->sendError(__('Cannot login, Branch is not active'));
                        }

                        $url = $tenant->impersonationUrl($user->id,'dashboard');
                        Auth::logout();
                        return $this->sendResponse([
                            'url' => $url
                        ], __('OK User logged in successfully.'));
    
                    }
                });
            }
            return $this->sendError(__('Invalid email or password'), ['error' => __('Invalid email or password')]);
        }

        $user = Auth::user();
        if($user->isBlocked() ){
            Auth::logout();
            return $this->sendError(__('This account has been blocked'), ['error' => __('blocked-user')]);
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
