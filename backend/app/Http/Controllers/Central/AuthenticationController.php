<?php

namespace App\Http\Controllers\Central;

use App\Models\User;
use App\Utils\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * Json Auth Validation
     *
     * @return JsonResponse
     */
    public function auth_validation(): JsonResponse
    {
        /** @var ?User $user */
        $user = auth()?->user();


        if ($user) {
            if($user->isBlocked()){
                return ResponseHelper::response([
                    'message' => 'User is Blocked',
                    'is_loggedin' => false
                ], ResponseHelper::HTTP_BLOCKED);
            }
            else if ($user->hasVerifiedEmail()) {
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
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        /** @var ?User $user */
        $user = auth()?->user();

        if ($user) {
            Auth::logout();
            return ResponseHelper::response([
                'message' => 'logged out successfully',
                'is_loggedin' => false
            ], ResponseHelper::HTTP_OK);
        }
        return ResponseHelper::response([
            'message' => 'User is not logged in',
            'is_loggedin' => false
        ], ResponseHelper::HTTP_FORBIDDEN);
    }

}
