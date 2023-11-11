<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsNotBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if($user->isBlocked()){
            if ($request->expectsJson()) {
                return ResponseHelper::response([
                    'message' => 'User is Blocked',
                    'is_loggedin' => false
                ], ResponseHelper::HTTP_BLOCKED);
            }
            return redirect()->route("login");
        }
        return $next($request);
    }
}
