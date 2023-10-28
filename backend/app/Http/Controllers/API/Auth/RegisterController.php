<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\BaseController;
use App\Models\Restaurant;
use App\Models\TraderRequirement;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;

class RegisterController extends BaseController
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|min:10|max:255|unique:users',
            'position' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:6|max:255',
            'c_password' => 'required|same:password',
            'phone' => 'required|string|min:10|max:14',
            'terms_and_policies' => 'accepted',
            'restaurant_name' => 'required|string|min:3|max:255',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['status'] = 'inactive';
        $user = User::create($input);
        $success['token'] =  $user->createToken('Personal Access Token')->accessToken;
        $success['name'] =  "$user->first_name $user->last_name";
        $this->sendVerificationCode($request);

        $restaurant = new Restaurant();
        $restaurant->name = [
            'ar' => $input['restaurant_name'],
            'en' => null,
        ];
        $restaurant->save();

        $user->assignRole('Restaurant Owner');
        Auth::login($user);
        return $this->sendResponse($success, 'User register successfully.');
    }

    public function stepTwo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'commercial_registration' => 'required|mimes:pdf|max:2048',
            'tax_registration_certificate' => 'required|mimes:pdf|max:2048',
            'bank_certificate' => 'required|mimes:pdf|max:2048',
            'identity_of_owner_or_manager' => 'required|mimes:pdf|max:2048',
            'national_address' => 'required|mimes:pdf|max:2048',
            'IBAN' => 'required|string|min:10|max:255',
            'facility_name' => 'required|string|min:5|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $request->all());
        }

        $user = auth('api')->user();

        $requirements = $user->traderRegistrationRequirement;

        // Check if the trader's registration requirements are not fulfilled.
        if (isset($requirements) &
            isset($requirements->IBAN) &
            isset($requirements->facility_name) &
            isset($requirements->tax_registration_certificate) &
            isset($requirements->bank_certificate) &
            isset($requirements->identity_of_owner_or_manager) &
            isset($requirements->national_address)
        ) {
            return $this->sendResponse(null, 'User complete register step2 successfully.');
        }

        $user_id = $user->id;

        $input = $request->all();
        $input['user_id'] = $user_id;

        // Ensure the directory exists and is writable
        $directory = storage_path("app/private/user_files/{$user_id}");
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
                    "private/user_files/{$user_id}",
                    $fileKey . '_' . hash_file('sha256', $request->file($fileKey)->getRealPath()) . '.' . $request->file($fileKey)->getClientOriginalExtension(),
                    'local'
                );
            }
        }


        TraderRequirement::create($input);

        return $this->sendResponse(null, 'User complete register step2 successfully.');
    }


    public function sendVerificationCode(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email|min:10|max:255',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

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

        // Send the email with the verification code
        Mail::send('emails.verify', ['code' => $user->verification_code, 'name' => "$user->first_name $user->last_name"], function($message) use ($request) {
            $message->to($request->email);
            $message->subject('Email Verification Code');
        });

        return $this->sendResponse(null, 'Verification code sent to email.');
    }

    public function verify(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email|min:10|max:255',
            'code' => 'required|string|min:6|max:6', // Assuming a 6-digit code
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = User::where('email', $request->email)->first();

        // If the user has already verified their email
        if ($user->email_verified_at !== null) {
            return $this->sendError('Fail', 'Email is already verified.');
        }

        // Check the verification code
        if ($user->checkVerificationCode($request->code)) {
            $user->email_verified_at = now();
            $user->verification_code = null; // Clear the verification code
            $user->save();

            return $this->sendResponse(null, 'Email verified successfully!');
        }

        // If we've reached here, the verification code is incorrect
        // Note: You may want to track the number of incorrect attempts and handle them accordingly.
        return $this->sendError('Fail', 'The verification code is incorrect.');
    }

}
