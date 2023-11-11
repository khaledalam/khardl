<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // // Check if the user is authenticated and has the "Restaurant Owner" role.
        if (!$user->isAdmin()) {
            if ($request->expectsJson()) {
                return ResponseHelper::response([
                    'message' => 'Forbidden access admin dashboard',
                    'is_loggedin' => true
                ], ResponseHelper::HTTP_FORBIDDEN);
            }
            return redirect()->route("home");
        }

        // If the user is not a "Restaurant Owner" or has already fulfilled registration requirements, continue.
        return $next($request);
    }
}

