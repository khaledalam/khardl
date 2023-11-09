<?php

namespace App\Http\Middleware;

use App\Utils\ResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()->hasVerifiedEmail()) {
                if ($request->expectsJson()) {
                    return ResponseHelper::response([
                        'message' => 'User email is not verified yet',
                        'is_loggedin' => true
                    ], ResponseHelper::HTTP_NOT_VERIFIED);
                }
                return redirect()->route("verification-email");
        }
        return $next($request);
    }
}
