<?php

namespace App\Http\Controllers\Web\Tenant\Auth;


use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use App\Packages\Msegat\Msegat;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Tenant\RestaurantUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Tenant\OTPRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Tenant\CustomerSendSMSRequest;
use App\Http\Requests\Tenant\CustomerRegisterRequest;
use App\Packages\TapPayment\Customer\Customer as CustomerTap;
use App\Http\Controllers\API\Central\Auth\RegisterController as RegisterControllerCentral;


class RegisterController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string|unique:users',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'c_password' => 'required|same:password',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $contents = file_get_contents($data['commercial_registration']);
        $fileName = Str::random(40) . '.' . $data['commercial_registration']->getClientOriginalExtension();
        $filePath = 'private/commercial_registration/' . $fileName;
        Storage::disk('local')->put($filePath, $contents);

        return RestaurantUser::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'restaurant_name' => $data['restaurant_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'commercial_registration_pdf' => $fileName,
            'membership' => 0
        ]);
    }

    public function register(CustomerRegisterRequest $request)
    {
        $this->validate($request,[
            'otp' => 'required|string' ,
            'id_sms' => 'required|string' ,
        ]);
        if(!(new LoginCustomerController)->checkVerificationSMSCodeOnly($request->otp,$request->id_sms)){
            return $this->sendError(__('Invalid code'));
        }
        if(!$user = RestaurantUser::create($request->validated(),true)){
            \Sentry\captureMessage("register Customer app : " . json_encode($request->all()));
            return   $this->sendError(__('Something wrong happen'));
        }
        $user->update([
            'msegat_id_verification'=>$request->id_sms,
            'phone_verified_at' => now(),
            'status'=> RestaurantUser::ACTIVE
        ]);
        Auth::login($user,true);
        return $this->sendResponse($user, 'Customer registered successfully.');
    }



    public function verify(OTPRequest $request): JsonResponse
    {
        $user = Auth::user();
        // If the user has already verified their phone
        if ($user->phone_verified_at !== null) {
            return $this->sendError('Fail', 'Phone is already verified.');
        }
        if(!$this->checkAttempt($user)){
            return $this->sendError('Fail', __('Too many attempts. Request a new verification code after 15 minutes from now.'));
        }
        // Check the verification code
        if (!$user->checkVerificationSMSCode($request->otp))
            return $this->sendError('Fail', __('The verification code is incorrect.'));

        // If we've reached here, the verification code is incorrect
        // Note: You may want to track the number of incorrect attempts and handle them accordingly.
        return $this->sendResponse(null, __('Phone verified successfully!'));

    }
    public function checkAttempt($user){
        $today = Carbon::today();
        $tokens = DB::table('phone_verification_tokens')
        ->where('user_id', $user->id)
        ->whereDate('created_at', $today)->get()->first();
        if (isset($tokens) && $tokens->attempts >= 5 && !in_array($user->phone,Msegat::ALLOWED_NUMBERS)) {
            return false;
        }
        return true;
    }
}
