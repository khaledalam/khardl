<?php

namespace App\Http\Middleware;

use App\Utils\ResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsNotVerified
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->hasVerifiedEmail()) {
            if ($request->expectsJson()) {
                return ResponseHelper::response([
                    'message' => 'User is already verified his email',
                    'is_loggedin' => true
                ], ResponseHelper::HTTP_VERIFIED);
            }
            return redirect()->route("dashboard");
        }
        return $next($request);
    }
}
