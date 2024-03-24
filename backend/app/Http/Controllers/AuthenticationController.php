<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Token;

class AuthenticationController extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest');
    }

    /**
     * Json Auth Validation
     *
     * @return JsonResponse
     */
    public function auth_validation(Request $request): JsonResponse
    {
        /** @var ?User $user */
        $user = Auth::user();
//        var_dump($user);


        if ($user) {
//            if($user->isBlocked()){
//                return ResponseHelper::response([
//                    'message' => 'User is Blocked',
//                    'is_loggedin' => false
//                ], ResponseHelper::HTTP_BLOCKED);
//            }
//            else
//
            if ($user->hasVerifiedEmail()) {
                if (!$user?->traderRegistrationRequirement || $user->isRejected()) {
                    return ResponseHelper::response([
                        'message' => 'User trader documents are not approved yet',
                        'is_loggedin' => true
                    ], ResponseHelper::HTTP_NOT_ACCEPTED);
                }
            } else {
                return ResponseHelper::response([
                    'message' => 'User is not verified email yet',
                    'is_loggedin' => true,
                    'email' => $user?->email
                ], ResponseHelper::HTTP_NOT_VERIFIED);
            }
            return ResponseHelper::response([
                'message' => 'User is authenticated',
                'default_locale'   => $user->default_lang,
                'is_loggedin' => true
            ], ResponseHelper::HTTP_OK);
        }


        return ResponseHelper::response([
            'message' => 'User is not authenticated',
            'default_locale'   => app()->getLocale(),
            'is_loggedin' => false
        ], ResponseHelper::HTTP_NOT_AUTHENTICATED);
    }



    /**
     * logout
     *
     */
    public function logout(Request $request)
    {
        /** @var ?User $user */
        $user = auth()?->user();

        if ($user) {
            $user?->restaurant?->run(function($tenant){
                $user = User::where('email',$tenant->email)->first();
                if($user){
                    $user->update(['force_logout' => 1]);
                }
            });
            Auth::logout();
            if ($request->expectsJson()) {
                return ResponseHelper::response([
                    'message' => 'logged out successfully',
                    'is_loggedin' => false
                ], ResponseHelper::HTTP_OK);
            }
            return redirect()->route("home");
        }

        if ($request->expectsJson()) {
            return ResponseHelper::response([
                'message' => 'User is not logged in',
                'is_loggedin' => false
            ], ResponseHelper::HTTP_OK);
        }
        return redirect()->route("login");
    }

}
