<?php

namespace App\Http\Controllers\Web\Tenant\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use App\Models\ROSubscription;
use App\Models\Tenant\Setting;
use App\Packages\Msegat\Msegat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Tenant\OTPRequest;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Tenant\CustomerLoginRequest;
use App\Http\Requests\Tenant\OTPCustomerAppRequest;
use App\Http\Requests\UpdateCustomerInfoAppRequest;
use App\Http\Requests\Tenant\CustomerSendSMSRequest;
use App\Http\Requests\Tenant\CustomerAppLoginRequest;
use App\Http\Requests\Tenant\CustomerRegisterRequest;

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

    public function login(CustomerSendSMSRequest $request)
    {
        // @TODO: Improve the way that we fetch user (add throttle, and IP limitations)
        $user = RestaurantUser::where("phone", $request->phone)->first();

        if (!$user && !$request->otp) {
            return $this->sendError(__("If phone number is registered with us, an OTP SMS will be sent"), [])
                ->setStatusCode(ResponseHelper::HTTP_BAD_REQUEST);
        }

        if (!$user && $request->otp) {
            return $this->sendError(__("Maybe phone number is not registered or OTP code is wrong"), [])
                ->setStatusCode(ResponseHelper::HTTP_FORBIDDEN);
        }

        if(strlen($request->otp) != 4){
            $response =  $this->sendSMS($request);
            return $response->setStatusCode(ResponseHelper::HTTP_BAD_REQUEST);
        }

        if ($request->otp && $request->id_sms) {
            if (!$this->checkVerificationSMSCodeOnly($request->otp, $request->id_sms)) {
                return $this->sendError(__('Invalid code'));
            }
        } else {
            return $this->sendError(__("Missing inputs"), []);
        }

        if(!$user?->isRestaurantOwner() && (!Setting::first()?->is_live || ROSubscription::first()?->status != ROSubscription::ACTIVE)){
            Auth::logout();
            return $this->sendError(__("Website doesn't have active subscription, Only restaurant owner can login"), []);
        }
        if(($user?->isDriver()  || $user?->isWorker() ) && !$user->branch?->active){
            Auth::logout();
            return $this->sendError(__('Cannot login, Branch is not active'), []);
        }
        if(!$this->checkAttempt($user)){
            return $this->sendError('Fail', __('Too many attempts. Request a new verification code after 15 minutes from now.'));
        }
        if(!$this->checkVerificationSMSCodeOnly($request->otp,$request->id_sms)){
            return $this->sendError(__('Invalid code'));
        }
        $user->status = RestaurantUser::ACTIVE;
        $user->phone_verified_at = now();
        $user->force_logout = 0;
        $user->save();

        Auth::loginUsingId($user->id,true);
        $user = Auth::user();
        $user->load(['roles']);
        $data = [
            'user'=>$user
        ];
        return $this->sendResponse($data, __('User logged in successfully.'));
    }
    public function loginCustomerOnly(CustomerAppLoginRequest $request){
        if(!Setting::first()?->is_live || ROSubscription::first()?->status != ROSubscription::ACTIVE){
            return $this->sendError(__("Website doesn't have active subscription, Only restaurant owner can login"), []);
        }
        $user = RestaurantUser::where("phone",$request->phone)->first();
        if(!$this->checkAttempt($user)){
            return $this->sendError('Fail', __('Too many attempts. Request a new verification code after 15 minutes from now.'));
        }
        if(!$this->checkVerificationSMSCodeOnly($request->otp,$request->id_sms)){
            return $this->sendError(__('Invalid code'));
        }
        if(!$user->isCustomer()){
            return $this->sendError(__("Unauthorized"), []);
        }

        $user->force_logout = 0;
        $user->save();
        $data = [
            'user'=>$user
        ];
        $user->tokens()?->delete();

        $token = $user->createToken('Personal Access Token');
        $token->expires_at = Carbon::now()->addMonths(1);


        $data = [
            'user'=>$user,
            'token_type' => 'Bearer',
            'access_token' => $token,
        ];

        return $this->sendResponse($data, __('User logged in successfully.'));

    }
    public function registerCustomerOnly(CustomerRegisterRequest $request){
        $this->validate($request,[
            'otp' => 'required|string' ,
            'id_sms' => 'required|string' ,
        ]);
        if(!$this->checkVerificationSMSCodeOnly($request->otp,$request->id_sms)){
            return $this->sendError(__('Invalid code'));
        }
        if(!$user = RestaurantUser::create($request->validated(),true)){
            \Sentry\captureMessage("register Customer app : " . json_encode($request->all()));
            return   $this->sendError(__('Something wrong happen'));
        }
        $user->update([
            'msegat_id_verification'=>$request->id_sms,
            'phone_verified_at' => now()
        ]);
        $data = [
            'user'=>$user
        ];
        $user->tokens()?->delete();

        $token = $user->createToken('Personal Access Token');
        $token->expires_at = Carbon::now()->addMonths(1);


        $data = [
            'user'=>$user,
            'token_type' => 'Bearer',
            'access_token' => $token,
        ];

        return $this->sendResponse($data, __('User logged in successfully.'));
    }
    public function sendVerificationSMSCode(Request $request)
    {
        $user = Auth::user();
        if(!$this->checkAttempt($user)){
            Auth::logout();
            return false;
        }
        if(!$id= $user->generateVerificationSMSCode()) return $this->sendError('Fail', __('Request failed .'));
        $user->msegat_id_verification = $id;
        $user->save();
        return true;
    }
    public function sendSMS(CustomerSendSMSRequest $request)
    {
        $sms = $this->generateVerificationSMSCodeOnly($request->phone);
        if(is_null($sms)){
            return $this->sendError(__('The maximum number of text messages has been used today. Please try again later'));
        }else if(!$sms) {
            \Sentry\captureMessage("SMS NOT BEING DELIVERED");
            return $this->sendError(__('An error has occurred, please try again later'));
        }

        return $this->sendResponse([
            'id'=> $sms
        ],__('A SMS has been sent successfully'));

    }
    public function VerifyCustomerPhone(OTPCustomerAppRequest $request){
       if($this->checkVerificationSMSCodeOnly($request->otp,$request->id_sms)){
            $user = getAuth();
            $user->update([
                'phone'=>$user->verified_phone,
                'verified_phone'=>$user->phone,
            ]);
            return $this->sendResponse([],__('Your phone is verified successfully'));
        }else {
            return $this->sendError(__('Invalid code'));
        }


    }
    public function updateCustomerApp(UpdateCustomerInfoAppRequest $request){
        $user = Auth::user();

        if($request->first_name){
            $user->first_name = $request->first_name;
        }
        if($request->last_name){
            $user->last_name = $request->last_name;
        }
        if($request->email){
            $user->email = $request->email;
        }
        $user->save();
        if ($request->phone && $user->phone != $request->phone) {
            $send_sms = $this->sendSMS(
                new CustomerSendSMSRequest($request->all())
            );
            $content = $send_sms->getOriginalContent();
            if($content['success']){
                $user->verified_phone = $request->phone;
                $user->save();
            }
            return $send_sms;

        }else {
            $user->save();
            return $this->sendResponse([
                'ok' => true,
            ], __('User updated successfully'));
        }


    }
     public function checkVerificationSMSCodeOnly(string $otp,$id)
    {
        $response = Msegat::verifyOTP(
            otp: $otp,
            id: $id
        );
        if ($response['http_code'] == ResponseHelper::HTTP_OK) {
            return true;
        }
        return false;
    }
    public function generateVerificationSMSCodeOnly($phone )
    {
        $response = Msegat::sendOTP(
            number: $phone
        );
        if(!$this->checkAttempt($phone)){
            return null;
        }
        $this->newAttempt($phone);
        if($response['http_code'] == ResponseHelper::HTTP_OK){
            $id =  $response['message']['id'];
            return $id;
        }else {
            return false;
        }
    }
    public function checkAttempt($phone = null){
        $today = Carbon::today();
        $tokens = DB::table('phone_verification_tokens')
        ->where('phone',$phone)
        ->whereDate('created_at', $today)->first();

        if (isset($tokens) && $tokens->attempts >= 10  && !in_array($phone,Msegat::ALLOWED_NUMBERS))  {
            return false;
        }
        return true;
    }
    public function newAttempt($phone)
    {
        DB::table('phone_verification_tokens')
            ->updateOrInsert([
                'phone' => $phone,
            ],
            [
                'attempts' => DB::raw('attempts + 1'),
            ]);
    }

}
