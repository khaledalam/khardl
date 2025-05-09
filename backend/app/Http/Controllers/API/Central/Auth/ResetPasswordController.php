<?php

namespace App\Http\Controllers\API\Central\Auth;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use Illuminate\Support\Carbon;
use App\Jobs\SendVerifyEmailJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\ValidateEmailOrPhoneRequest;

class ResetPasswordController extends BaseController
{
    public function forgot(ValidateEmailOrPhoneRequest $request): JsonResponse
    {

        if ($request->has('login_code') && $request->login_code){
            $validator = Validator::make($request->all(), [
                'emailOrPhone' => 'required|email|min:10|max:255',
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $tenant = Tenant::whereJsonContains('data->mapper_hash', $request->login_code)->first();
            if (!$tenant) {
                return $this->sendError(__('Invalid login code.'));
            }

            return $tenant->run(function () use($request) {
                $user = RestaurantUser::workers()->where('email',$request->emailOrPhone)->first();
                if($user){
                    return $this->resetPasswordEmail($request);
                }else{
                    return $this->sendError(__('Wrong credentials'));
                }
            });
        }
        if (filter_var($request->emailOrPhone, FILTER_VALIDATE_EMAIL)) {
            if($request->otp && $request->token){
                if($db = DB::table('password_reset_tokens')->where('token', $request->token)->first()){
                    if($user = User::where('phone',$db->email)->first()){
                        if($user->checkVerificationSMSCode($request->otp,$request->token)){
                            $user->email = $request->emailOrPhone;
                            $user->email_verified_at = null;
                            $user->generateVerificationCode();
                            SendVerifyEmailJob::dispatch($user);
                            $user->save();
                            Auth::login($user,true);
                            $data = [
                                'user'=>$user
                            ] ;
                            DB::table('password_reset_tokens')->where('token', $request->token)->delete();
                            return $this->sendResponse($data, __('User logged in successfully.'));
                        }
                    }
                }
                return $this->sendError(__('Wrong credentials'));


            }
            return  $this->resetPasswordEmail($request);
        }else {
            return  $this->resetPasswordPhone($request);
        }
      

    }
    public function resetPasswordEmail($request)
    {
        $today = Carbon::today();


        $tokens = DB::table('password_reset_tokens')
            ->where('email', $request->emailOrPhone)
            ->whereDate('created_at', $today)->first();

        if ($tokens && $tokens->attempts >=3) {
            return $this->sendError( __('Too many failed attempts. Request a new reset code.'));
        }

        $token = rand(100000, 999999);
        if(DB::table('password_reset_tokens')->where('email', $request->emailOrPhone)->whereDate('created_at', $today)->first()){
            DB::table('password_reset_tokens')->where('email', $request->emailOrPhone)->whereDate('created_at', $today)->update([
                'attempts' => DB::raw('attempts + 1'),
                'token' => $token
            ]);
        }else{
            if(DB::table('password_reset_tokens')->where('email', $request->emailOrPhone)->first()){
                DB::table('password_reset_tokens')->where('email', $request->emailOrPhone)->update([
                    'attempts' => 1,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
            }else{
                DB::table('password_reset_tokens')->insert([
                    'email' => $request->emailOrPhone,
                    'attempts' => 1,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        $user = User::where(['email' => $request->emailOrPhone])->select(['first_name', 'last_name'])->first();

        // Send the email with the token
        Mail::send('emails.password', ['token' => $token,'name' => "$user->full_name" ], function($message) use ($request) {
            $message->to($request->emailOrPhone);
            $message->subject(__('Password Reset Request'));
        });
        return $this->sendResponse(true, 'Reset email sent.');
    }
    public function resetPasswordPhone(Request $request){
        $today = Carbon::today();

        $user = User::where(['phone' => $request->emailOrPhone])->first();
        if(!$user){
            return $this->sendError(__('If phone number is registered with us, an OTP SMS will be sent'),[
                'id'=> 99999
            ],ResponseHelper::HTTP_LOCKED);
        }
        $tokens = DB::table('password_reset_tokens')
            ->where('email', $request->emailOrPhone)
            ->whereDate('created_at', $today)->first();

        if ($tokens && $tokens->attempts >=3) {
            return $this->sendError(__('Too many failed attempts. Request a new reset code.'));
        }

        $token = $user->generateVerificationSMSCode();
        if(!$token){
            return $this->sendError( __('Request failed .'));
        }
        if(DB::table('password_reset_tokens')->where('email', $request->emailOrPhone)->whereDate('created_at', $today)->first()){
            DB::table('password_reset_tokens')->where('email', $request->emailOrPhone)->whereDate('created_at', $today)->update([
                'attempts' => DB::raw('attempts + 1'),
                'token' => $token
            ]);
        }else{
            if(DB::table('password_reset_tokens')->where('email', $request->emailOrPhone)->first()){
                DB::table('password_reset_tokens')->where('email', $request->emailOrPhone)->update([
                    'attempts' => 1,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
            }else{
                DB::table('password_reset_tokens')->insert([
                    'email' => $request->emailOrPhone,
                    'attempts' => 1,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
      
        return $this->sendError(__('Please enter the OTP code'),[
            'id'=> $token
        ],ResponseHelper::HTTP_LOCKED);
    }
    public function reset(Request $request): JsonResponse
    {
        if ($request->has('login_code') && $request->login_code){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|min:10|max:255',
                'password' => 'required|string|min:6|max:255',
                'c_password' => 'required|same:password',
                'token' => 'required|min:6|max:6'
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $tenant = Tenant::whereJsonContains('data->mapper_hash', $request->login_code)->first();
            if (!$tenant) {
                return $this->sendError(__('Invalid login code.'));
            }
            return $tenant->run(function () use($request) {
                $user = RestaurantUser::workers()->where('email',$request->email)->first();
                if($user){
                    return $this->completeResetPassword($request);
                }else{
                    return $this->sendError(__('Wrong credentials'));
                }
            });
        }else{
            $request->validate([
                'email' => 'required|email|exists:users,email|min:10|max:255',
                'password' => 'required|string|min:6|max:255',
                'c_password' => 'required|same:password',
                'token' => 'required|min:6|max:6'
            ]);
            return $this->completeResetPassword($request);
        }

    }
    public function completeResetPassword($request)
    {
        $tokenData = DB::table('password_reset_tokens')
        ->where('email',$request->email)
        ->where('token', $request->token)
        ->first();

        if (!$tokenData){
            return $this->sendError(__('Invalid token.'));
        }

        $user = User::where('email', $tokenData->email)->first();

        $user->password = Hash::make($request->password);
        $user->save();


        DB::table('password_reset_tokens')->where('token', $request->token)->delete();

        return $this->sendResponse(null, __('Password reset successfully.'));
    }
}
