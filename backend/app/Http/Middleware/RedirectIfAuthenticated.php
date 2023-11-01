<?php

namespace App\Http\Middleware;

use App\Utils\ResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param string ...$guards
     * @return Response
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($request->expectsJson()) {
                    return ResponseHelper::response('User is already authenticated', ResponseHelper::HTTP_AUTHENTICATED);
                }
                return redirect()->route("central.dashboard");
            }
        }

        return $next($request);
    }
}
