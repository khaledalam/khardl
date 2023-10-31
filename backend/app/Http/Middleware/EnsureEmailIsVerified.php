<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
                    $response = [
                        'success' => false,
                        'message' => 'Not Verified',
                        'data' =>['error' => 'Not Verified']
                    ];
        
                    return response()->json($response, 401);
                }
                return redirect()->route("central.verification-email");
        }
        return $next($request);
    }
}
