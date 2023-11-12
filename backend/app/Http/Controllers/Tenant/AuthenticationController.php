<?php

namespace App\Http\Controllers\Tenant;

use App\Models\User;
use Laravel\Passport\Token;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    

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
            if (!$user->hasVerifiedEmail()) {
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
            return redirect()->route("home");
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
