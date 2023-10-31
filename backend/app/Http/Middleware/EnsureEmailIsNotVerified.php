<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Classes\ResponseCode;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsNotVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->hasVerifiedEmail()) {
            if ($request->expectsJson()) {
                $response = new ResponseCode();
                return $response->Verified($response::HTTP_FORBIDDEN);
            }
            return redirect()->route("central.dashboard");
        }
        return $next($request);
    }
}
