<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Classes\ResponseCode;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
                    $response = new ResponseCode();
                    return $response->NotVerified($response::HTTP_FORBIDDEN);
                }
                return redirect()->route("central.verification-email");
        }
        return $next($request);
    }
}
