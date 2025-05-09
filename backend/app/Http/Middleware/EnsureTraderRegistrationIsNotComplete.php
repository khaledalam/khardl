<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Utils\ResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTraderRegistrationIsNotComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Check if the user is authenticated and has the "Restaurant Owner" role.
        if ($user && $user->hasRole('Restaurant Owner')) {

            // Check if the trader's registration requirements are not fulfilled.
            if ($user->traderRegistrationRequirement && !$user?->isRejected()) {
                if ($request->expectsJson()) {
                    return ResponseHelper::response([
                        'message' => 'User is already approved',
                        'is_loggedin' => true
                    ], ResponseHelper::HTTP_ACCEPTED);
                }
                return redirect()->route("home");

            }
        }

        // If the user is not a "Restaurant Owner" or has already fulfilled registration requirements, continue.
        return $next($request);
    }
}
