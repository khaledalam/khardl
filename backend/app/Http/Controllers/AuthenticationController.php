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
                if (!$user?->traderRegistrationRequirement) {
                    return ResponseHelper::response([
                        'message' => 'User trader documents are not approved yet',
                        'is_loggedin' => true
                    ], ResponseHelper::HTTP_NOT_ACCEPTED);
                }
            } else {
                return ResponseHelper::response([
                    'message' => 'User is not verified email yet',
                    'is_loggedin' => true
                ], ResponseHelper::HTTP_NOT_VERIFIED);
            }
            return ResponseHelper::response([
                'message' => 'User is authenticated',
                'is_loggedin' => true
            ], ResponseHelper::HTTP_OK);
        }


        return ResponseHelper::response([
            'message' => 'User is not authenticated',
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
            Auth::logout();
            if ($request->expectsJson()) {
                return ResponseHelper::response([
                    'message' => 'logged out successfully',
                    'is_loggedin' => false
                ], ResponseHelper::HTTP_OK);
            }
            return redirect()->route("dashboard");
        }

        if ($request->expectsJson()) {
            return ResponseHelper::response([
                'message' => 'User is not logged in',
                'is_loggedin' => false
            ], ResponseHelper::HTTP_FORBIDDEN);
        }
        return redirect()->route("login");
    }

}
