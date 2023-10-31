<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($request->expectsJson()) {
                    $errorMessages = 'User is already registered with this email address.';
                    $response = [
                        'success' => false,
                        'message' => 'Authorized',
                        'data' => $errorMessages
                    ];
        
                    return response()->json($response, 401);
                }
                return redirect()->route("central.dashboard");
            }
        }

        return $next($request);
    }
}
