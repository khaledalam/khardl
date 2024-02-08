<?php

namespace App\Http\Controllers\Web\Central\Auth;

use App\Http\Controllers\API\Central\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\BaseController;
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
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials,true)) {
            return $this->sendError('Unauthorized.', ['error' => __('Invalid email or password')]);
        }

        $user = Auth::user();
        if($user->isBlocked() ){
            Auth::logout();
            return $this->sendError('Unauthorized.', ['error' => __('messages.blocked-user')]);
        }elseif(!$user->isActive()){
            $register = new RegisterController();
            $register->sendVerificationCode($request);
        }
        // @TODO: uncomment if need!
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
