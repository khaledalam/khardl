<?php

namespace App\Http\Controllers\Web\Tenant\Auth;

use App\Http\Controllers\Web\BaseController;
use App\Models\ROSubscription;
use App\Models\Subscription;
use App\Models\Subscription as CentralSubscription;
use App\Models\Tenant\Setting;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
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
//        dd("TEST");
//        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|min:10|max:255',
            'password' => 'required|string|min:6|max:255',
            'remember_me' => 'nullable|boolean',
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials, true)) {
            return $this->sendError( __('Invalid email or password'),[] );
        }
        $user = Auth::user();
        if(!$user?->isRestaurantOwner() && (!Setting::first()?->is_live || ROSubscription::first()?->status != ROSubscription::ACTIVE)){
            Auth::logout();
            return $this->sendError(__("Website doesn't have active subscription, Only restaurant owner can login"), []);
        }
        if ($user?->isRejected()) {
            Auth::logout();
            return $this->sendError(__("Account requirements rejected، please resubmit from main domain"), []);
        }

        if(($user?->isDriver() || $user?->isWorker() ) && !$user->branch?->active){
            Auth::logout();
            return $this->sendError(__('Cannot login, Branch is not active'), []);
        }

//        tenancy()->central(function() use($credentials){
//            Auth::attempt($credentials, true);
//        });

        $data = [
            'user'=>$user
        ];

        return $this->sendResponse($data, __('User logged in successfully.'));
    }
}
