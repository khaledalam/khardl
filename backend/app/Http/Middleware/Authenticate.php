<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Classes\ResponseCode;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            $response = new ResponseCode();
            return $response->UnAuthenticated($response::HTTP_FORBIDDEN);
        }
        return $request->expectsJson() ? null : route('login');
    }
}
