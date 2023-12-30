<?php

namespace App\Http\Controllers\API\Central\Auth;

use App\Jobs\SendVerifyEmailJob;
use App\Models\Log;
use App\Models\Tenant\RestaurantUser;
use App\Models\User;
use App\Models\Promoter;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Rules\UniqueSubdomain;
use Illuminate\Support\Carbon;
use App\Jobs\CreateTenantAdmin;
use App\Models\PromoterIpAddress;
use App\Models\TraderRequirement;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Actions\CreateTenantAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\RestaurantOwnerRegisterRequest;

class RegisterController extends BaseController
{
    public function register(RestaurantOwnerRegisterRequest $request): JsonResponse
    {
        $input = $request->validated();
        $input['password'] = Hash::make($input['password']);
        $input['status'] = 'inactive';
        $user = User::create($input);
        $success['token'] =  $user->createToken('Personal Access Token')->accessToken;
        $success['name'] =  "$user->first_name $user->last_name";
        $user->assignRole('Restaurant Owner');
        Auth::login($user);
        if($promoter = PromoterIpAddress::where('ip_address',request()?->ip())){
            $promoter->update(['registered'=>true]);
        }
        $this->sendVerificationCode($request);
        return $this->sendResponse($success, 'User register successfully.');
    }

    public function stepTwo(Request $request)
    {

        $request->validate([
            'commercial_registration' => 'required|mimes:pdf|max:2048',
            'tax_registration_certificate' => 'required|mimes:pdf|max:2048',
            'bank_certificate' => 'required|mimes:pdf|max:2048',
            'identity_of_owner_or_manager' => 'required|mimes:pdf|max:2048',
            'national_address' => 'required|mimes:pdf|max:2048',
            'IBAN' => 'required|string|min:10|max:255',
            'facility_name' => 'required|string|min:5|max:255',
        ]);

        $user = auth()->user();


        // Check if the trader's registration requirements already fulfilled.
        if ($user->traderRegistrationRequirement) {
            return $this->sendResponse(null, 'User already completed register step2 successfully.');
        }

        $user_id = $user->id;

        $input = $request->all();
        $input['user_id'] = $user_id;

        // Ensure the directory exists and is writable
        $directory = storage_path("app/private/".User::STORAGE."/{$user_id}");
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $fileNames = [
            'commercial_registration',
            'tax_registration_certificate',
            'bank_certificate',
            'identity_of_owner_or_manager',
            'national_address'
        ];

        foreach ($fileNames as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $input[$fileKey] = $request->file($fileKey)->storeAs(
                    "user_files/{$user_id}",
                    $fileKey . '_' . hash_file('sha256', $request->file($fileKey)->getRealPath()) . '.' . $request->file($fileKey)->getClientOriginalExtension(),
                    'private'
                );
            }
        }
        TraderRequirement::create($input);


        // Create tenant logic...

        $tenant = (new CreateTenantAction)
        (
            user: $user,
            domain: $user->restaurant_name
        );
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Has created new restaurant'
        ]);
        return $this->sendResponse(['url'=>$tenant->impersonationUrl(CreateTenantAdmin::RESTAURANT_OWNER_USER_ID)], 'User complete register step two successfully.');
    }


    public function sendVerificationCode(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email|min:10|max:255',
        ]);

        $today = Carbon::today();

        // You might want a new table to track verification code attempts.
        // Here, I'm assuming the table's name is `email_verification_tokens`.
        $attempts = DB::table('email_verification_tokens')
            ->where('email', $request->email)
            ->whereDate('created_at', $today)->get();

        if (count($attempts) >= 3) {
            return $this->sendError('Fail', 'Too many verification attempts. Request a new verification code.');
        }

        $user = User::where('email', $request->email)->first();

        // Generate the verification code using the model's method.
        $user->generateVerificationCode();

        SendVerifyEmailJob::dispatch($user);

        return $this->sendResponse(null, 'Verification code sent to email.');
    }

    public static function increasePromotersEntered($url){
        $promoter = Promoter::where('url', $url)->first();
        if (!$promoter) {
            abort(404);
        }
        PromoterIpAddress::firstOrCreate(['ip_address' => request()?->ip()], [
            'promoter_id' => $promoter->id
        ]);
    }

    // @TODO: register : collected from users table which is assigned ip address while registered

    public function verify(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email|min:10|max:255',
            'code' => 'required|string|min:6|max:6', // Assuming a 6-digit code
        ]);
        $user = User::where('email', $request->email)->first();

        // If the user has already verified their email
        if ($user->email_verified_at !== null) {
            return $this->sendError('Fail', 'Email is already verified.');
        }

        // Check the verification code
        if ($user->checkVerificationCode($request->code)) {
            $user->email_verified_at = now();
            $user->status = RestaurantUser::ACTIVE;
            $user->verification_code = $request->code; // Clear the verification code
            $user->save();

            return $this->sendResponse(null, 'Email verified successfully!');
        }

        // If we've reached here, the verification code is incorrect
        // Note: You may want to track the number of incorrect attempts and handle them accordingly.
        return $this->sendError('Fail', 'The verification code is incorrect.');
    }

}
