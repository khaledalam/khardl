<?php

namespace App\Http\Controllers\Web\Tenant;

use App\Models\Tenant\RestaurantStyle;
use App\Models\Tenant\RestaurantUser;
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
     * @param Request $request
     * @return JsonResponse
     */
    public function auth_validation(Request $request): JsonResponse
    {
        /** @var ?RestaurantUser $user */
        $user = Auth::user();

        // Adding R- version to invalidate and trigger fetching new style
        // on mobile side
        try {
            $restaurant_style_version = RestaurantStyle::first()?->version;
        } catch (\Throwable $exception) {

        }
        if ($user) {
            if (!$user->hasVerifiedPhone()) {
                return ResponseHelper::response([
                    'message' => 'User is not verified phone yet',
                    'is_loggedin' => true,
                    'phone' => $user?->phone
                ], ResponseHelper::HTTP_NOT_VERIFIED)->withHeaders([
                    "Restaurant-Style-Version"  => $restaurant_style_version
                ]);
            }
            return ResponseHelper::response([
                'message' => 'User is authenticated',
                'default_locale'   => $user->default_lang,
                'phone'=>$user->phone,
                'is_loggedin' => true
            ], ResponseHelper::HTTP_OK)->withHeaders([
                "Restaurant-Style-Version"  => $restaurant_style_version
            ]);
        }
        return ResponseHelper::response([
            'message' => 'User is not authenticated',
            'default_locale'   => app()->getLocale(),
            'is_loggedin' => false
        ], ResponseHelper::HTTP_NOT_AUTHENTICATED)->withHeaders([
            "Restaurant-Style-Version"  => $restaurant_style_version
        ]);
    }


    /**
     * logout
     */
    public function logout(Request $request)
    {
        /** @var ?User $user */
        $user = auth()?->user();
        if ($user) {

            tenancy()->central(function ($tenant) {
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

            return redirect()->route("homeCentral");
        }

        if ($request->expectsJson()) {
            return ResponseHelper::response([
                'message' => 'User is already logged out',
                'is_loggedin' => false
            ], ResponseHelper::HTTP_OK);
        }
        return redirect()->route("login");
    }

}
