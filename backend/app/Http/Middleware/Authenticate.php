<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            $errorMessages = 'You must be authenticated to access this resource. Please log in and try again.';
            $response = [
                'success' => false,
                'message' => 'Unauthorized',
                'data' => $errorMessages
            ];

            return response()->json($response, 401);
        }
        return $request->expectsJson() ? null : route('login');
    }
}
