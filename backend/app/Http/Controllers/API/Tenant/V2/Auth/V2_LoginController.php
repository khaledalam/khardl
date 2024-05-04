<?php

namespace App\Http\Controllers\API\Tenant\V2\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;

class V2_LoginController extends BaseController
{
    public function logout(Request $request)
    {
        /** @var ?User $user */
        $user = auth()?->user();
        if (!$user) {
            return ResponseHelper::response([
                'message' => 'Fail to logout, user is not logged in',
                'is_loggedin' => false
            ], ResponseHelper::HTTP_OK);
        }

        $user->tokens()->delete();
        Auth::logout();
        return ResponseHelper::response([
            'message' => 'logged out successfully',
            'is_loggedin' => false
        ], ResponseHelper::HTTP_OK);
    }
}
