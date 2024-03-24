<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Restaurant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        // // Check if the user is authenticated and has the "Restaurant Owner" role.
        if (!$user->isRestaurantOwner()) {
            if ($request->expectsJson()) {
                return ResponseHelper::response([
                    'message' => 'Forbidden access restaurant dashboard',
                    'is_loggedin' => true
                ], ResponseHelper::HTTP_FORBIDDEN);
            }
            return abort(403, 'Unauthorized');
        }

        if ($user->isRejected()) {
            if ($request->expectsJson()) {
                return ResponseHelper::response([
                    'message' => __('Account requirements rejected، please resubmit from main domain'),
                    'is_loggedin' => false
                ], ResponseHelper::HTTP_NOT_ACCEPTED);
            }
            return redirect()->route("complete-register");
        }
        // If the user is not a "Restaurant Owner" or has already fulfilled registration requirements, continue.

        return $next($request);
    }
}
