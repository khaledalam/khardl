<?php

namespace App\Http\Controllers\API\Tenant\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

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
            return $this->sendError('Unauthorized.', ['error' => __('Invalid email or password')]);
        }
        if(!Auth::user()->isWorker()){
            return $this->sendError('Unauthorized.', ['error' => __('Only workers can logged in')]);
        }


        $user = Auth::user();

        // @TODO: uncomment if need!
        $data = [
            'user'=>$user
        ];

        $token = $user->createToken('Personal Access Token');
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addMonths(1);
        } else {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $data= [
            'user'=>$user,
            'token_type' => 'Bearer',
            'access_token' => $token,
        ];


        return $this->sendResponse($data, __('User logged in successfully.'));
    }
    public function logout(Request $request)
    {
        /** @var ?User $user */
        $user = auth()?->user();
        $user->tokens()->delete();
        return ResponseHelper::response([
            'message' => 'logged out successfully',
            'is_loggedin' => false
        ], ResponseHelper::HTTP_OK);
    }
}
