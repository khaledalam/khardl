<?php

namespace App\Http\Middleware;

use App\Utils\ResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePhoneVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()->hasVerifiedPhone()) {
                if ($request->expectsJson()) {
                    return ResponseHelper::response([
                        'message' => 'User phone is not verified yet',
                        'is_loggedin' => true
                    ], ResponseHelper::HTTP_NOT_VERIFIED);
                }
                return redirect()->route("verification-phone");
        }
        return $next($request);
    }
}
