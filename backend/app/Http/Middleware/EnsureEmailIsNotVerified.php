<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
                $response = [
                    'success' => false,
                    'message' => 'Verified',
                    'data' =>['error' => 'Verified']
                ];
    
                return response()->json($response, 401);
            }
            return redirect()->route("central.dashboard");
        }
        return $next($request);
    }
}
