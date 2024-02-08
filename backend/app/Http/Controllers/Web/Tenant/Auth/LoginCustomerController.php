<?php

namespace App\Http\Controllers\Web\Tenant\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Tenant\CustomerLoginRequest;
use Illuminate\Support\Facades\DB;

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
        $this->sendVerificationSMSCode($request);
        $user->load(['roles']);
        $data = [
            'user'=>$user
        ];


        return $this->sendResponse($data, __('User logged in successfully.'));
    }

    public function sendVerificationSMSCode(Request $request)
    {
        $user = Auth::user();
        if(!$this->checkAttempt($user)){
            $this->sendError('Fail', 'Too many verification attempts. Request a new verification code.');
        }
        if(!$id= $user->generateVerificationSMSCode()) return $this->sendError('Fail', 'Request failed .');
        $user->msegat_id_verification = $id;
        $user->save();
    }

    public function checkAttempt($user){
        $today = Carbon::today();
        $tokens = DB::table('phone_verification_tokens')
            ->where('user_id', $user->id)
            ->whereDate('created_at', $today)->get()->first();
        if (isset($tokens) && $tokens->attempts >= 3) {
            return false;
        }
        return true;
    }
}
