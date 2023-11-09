<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class LoginController extends BaseController
{
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|min:10|max:255',
            'password' => 'required|string|min:6|max:255',
            'remember_me' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized']);
        }


        $user = Auth::user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        // Set token expiration based on 'remember_me'
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addMonths(1);
        } else {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();
        $user = User::where(['email' => $request->email])->select(['first_name','last_name','email','status'])->first();

        $data = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'user' => $user,
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ];

        $requirements = $user->traderRegistrationRequirement;

        // Check if the trader's registration requirements are not fulfilled.
        if (!isset($requirements) ||
            !isset($requirements->IBAN) ||
            !isset($requirements->facility_name) ||
            !isset($requirements->tax_registration_certificate) ||
            !isset($requirements->bank_certificate) ||
            !isset($requirements->identity_of_owner_or_manager) ||
            !isset($requirements->national_address)
        ) {
            $data['step2_status'] = 'incomplete';
        }else{
            $data['step2_status'] = 'completed';
        }

        return $this->sendResponse($data, 'User logged in successfully.');
    }
}
