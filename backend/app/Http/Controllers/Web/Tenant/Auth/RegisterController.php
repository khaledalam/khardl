<?php

namespace App\Http\Controllers\Web\Tenant\Auth;


use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        $input = $request->validated();
        // $input['password'] = Hash::make($input['password']);
        $input['status'] = RestaurantUser::INACTIVE;
        $user = RestaurantUser::create($input);
        // TODO @todo add tap customer to queue
        CustomerTap::createWithModel($user);
        $success['name'] =  "$user->first_name $user->last_name";
        $user->generateVerificationSMSCode();
        Auth::login($user,true);
        return $this->sendResponse($success, 'Customer registered successfully.');
    }

    public function sendVerificationSMSCode(Request $request):JsonResponse
    {
        $user = Auth::user();
        if(!$this->checkAttempt($user)){
            return $this->sendError('Fail', 'Too many verification attempts. Request a new verification code.');
        }
        if(!$id= $user->generateVerificationSMSCode()) return $this->sendError('Fail', 'Request failed .');
        $user->msegat_id_verification = $id;
        $user->save();
        return $this->sendResponse(null, 'Verification code sent to phone.');
    }
    public function verify(OTPRequest $request): JsonResponse
    {
        $user = Auth::user();
        // If the user has already verified their phone
        if ($user->phone_verified_at !== null) {
            return $this->sendError('Fail', 'Phone is already verified.');
        }
        if(!$this->checkAttempt($user)){
            return $this->sendError('Fail', 'Too many verification attempts. Request a new verification code.');
        }
        // Check the verification code
        if (!$user->checkVerificationSMSCode($request->otp))
            return $this->sendError('Fail', 'The verification code is incorrect.');

        // If we've reached here, the verification code is incorrect
        // Note: You may want to track the number of incorrect attempts and handle them accordingly.
        return $this->sendResponse(null, 'Phone verified successfully!');

    }
    public function checkAttempt($user){
        $today = Carbon::today();
        $tokens = DB::table('phone_verification_tokens')
        ->where('user_id', $user->id)
        ->whereDate('created_at', $today)->get()->first();
        if (isset($tokens) && $tokens->attempts >= 3 && !in_array($user->phone,Msegat::ALLOWED_NUMBERS)) {
            return false;
        }
        return true;
    }
}
