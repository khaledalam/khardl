<?php

namespace App\Http\Middleware;

use App\Utils\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return ResponseHelper::response('User is not authenticated', ResponseHelper::HTTP_UNAUTHORIZED);
        }
        return route('central.login');
    }
}
