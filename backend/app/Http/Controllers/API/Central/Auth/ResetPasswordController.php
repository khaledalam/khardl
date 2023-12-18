<?php

namespace App\Http\Controllers\API\Central\Auth;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ResetPasswordController extends BaseController
{
    public function forgot(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email|min:10|max:255',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $today = Carbon::today();

        
        $attempts = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->whereDate('created_at', $today)->get();

        if (count($attempts) >= 3) {
            return $this->sendError('Fail', 'Too many failed attempts. Request a new reset code.');
        }

        $token = rand(100000, 999999);
     
        DB::table('password_reset_tokens')
        ->updateOrInsert([
            'email' => $request->email,
        ],[
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);
        $user = User::where(['email' => $request->email])->select(['first_name', 'last_name'])->first();

        // Send the email with the token
        Mail::send('emails.password', ['token' => $token,'name' => "$user->first_name $user->last_name" ], function($message) use ($request) {
            $message->to($request->email);
            $message->subject('Password Reset Request');
        });
        return $this->sendResponse(true, 'Reset email sent.');
    }
    public function reset(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email|min:10|max:255',
            'password' => 'required|string|min:6|max:255',
            'c_password' => 'required|same:password',
            'token' => 'required|min:6|max:6'
        ]);

        $tokenData = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        if (!$tokenData){
            return $this->sendError('Fail', 'Invalid token.');
        }

        $user = User::where('email', $tokenData->email)->first();

        $user->password = Hash::make($request->password);
        $user->save();


        DB::table('password_reset_tokens')->where('token', $request->token)->delete();

        return $this->sendResponse(null, 'Password reset successfully.');
    }
}
