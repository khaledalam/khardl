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
            if ($user->hasVerifiedEmail()) {
                if (!$user?->traderRegistrationRequirement) {
                    return ResponseHelper::response('User trader documents are not approved yet', ResponseHelper::HTTP_NOT_ACCEPTED);
                }
            } else {
                return ResponseHelper::response('User is not verified email yet', ResponseHelper::HTTP_NOT_VERIFIED);
            }
            return ResponseHelper::response('User is authenticated', ResponseHelper::HTTP_OK);
        }

        return ResponseHelper::response('User is not authenticated', ResponseHelper::HTTP_UNAUTHORIZED);
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
            return ResponseHelper::response('logged out successfully', ResponseHelper::HTTP_OK);
        }
        return ResponseHelper::response('User is not logged in', ResponseHelper::HTTP_FORBIDDEN);
    }

}
