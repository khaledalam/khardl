<?php

namespace App\Http\Controllers\API\Tenant\Auth;

use App\Models\Tenant;
use App\Models\Tenant\RestaurantUser;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use App\Models\ROSubscription;
use App\Models\Tenant\Setting;
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

        if (!Auth::attempt($credentials,true)) {
            return $this->sendError(__('Unauthorized'), ['error' => __('Invalid email or password')]);
        }

        if(!Setting::first()?->is_live || ROSubscription::first()?->status != ROSubscription::ACTIVE){
            Auth::logout();
            return $this->sendError(__('Unauthorized'), ['error' => __("Website doesn't have active subscription, Only restaurant owner can login")]);
        }

        $user = RestaurantUser::where('email', '=', Auth::user()?->email)->first();

        if(!$user->isWorker() &&  !$user->isDriver()){
            Auth::logout();
            return $this->sendError(__('Unauthorized'), ['error' => __('Only workers and drivers can logged in')]);
        }

        if(!$user->branch?->active){
            Auth::logout();
            return $this->sendError(__('Unauthorized'), ['error' => __('Cannot login, Branch is not active')]);
        }

        // @TODO: uncomment if need!
        $data = [
            'user'=>$user
        ];
        // Revoke existing tokens for the user
        $user->tokens()->delete();

        $token = $user->createToken('Personal Access Token');
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addMonths(1);
        } else {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $user->load(['roles']);


        $data = [
            'user'=>$user,
            'token_type' => 'Bearer',
            'access_token' => $token,
            'subdomain' => $request->has('login_code') && $request->login_code ? tenant()?->restaurant_name : null,
            'worker_login' => $request->has('login_code') && $request->login_code
                ? Tenant::where('restaurant_name', '=', \tenant()->restaurant_name)->first()->impersonationUrl('') : null
        ];

        return $this->sendResponse($data, __('User logged in successfully.'));
    }
    public function logout(Request $request)
    {
        /** @var ?User $user */
        $user = auth()?->user();
        $user->tokens()->delete();
        Auth::logout();
        return ResponseHelper::response([
            'message' => 'logged out successfully',
            'is_loggedin' => false
        ], ResponseHelper::HTTP_OK);
    }
}
