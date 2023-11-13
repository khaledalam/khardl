<?php

namespace App\Http\Controllers\API\Central\Auth;

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
        $request->validate([
            'email' => 'required|string|email|min:10|max:255',
            'password' => 'required|string|min:6|max:255',
            'remember_me' => 'nullable|boolean',
        ]);


        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized']);
        }


        $user = Auth::user();

        // @TODO: uncomment if need!
        $data = [
            'user'=>$user
        ];

        if(Auth::guard() == 'api'){
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addMonths(1);
            } else {
                $token->expires_at = Carbon::now()->addWeeks(1);
            }
            $token->save();
            $data += [
                'token_type' => 'Bearer',
                'access_token' => $tokenResult->accessToken,
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
            ];
        }

        // Check if the trader's registration requirements are not fulfilled.
        if($user instanceof User){ // USER NOT RESTAURANT USER
            if (!$user->traderRegistrationRequirement) {
                $data['step2_status'] = 'incomplete';
            }else{
                $data['step2_status'] = 'completed';
            }
        }


        return $this->sendResponse($data, 'User logged in successfully.');
    }
}
