<?php

namespace App\Http\Middleware;

use App\Utils\ResponseHelper;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EnsureTraderRegistrationIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return JsonResponse|RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Check if the user is authenticated and has the "Restaurant Owner" role.
        if ($user && $user->hasRole('Restaurant Owner')) {

            // Check if the trader's registration requirements are not fulfilled.
            if (!$user->traderRegistrationRequirement || $user->isRejected()) {
                if ($request->expectsJson()) {
                    return ResponseHelper::response([
                        'message' => 'User trader documents are not approved yet',
                        'is_loggedin' => true
                    ], ResponseHelper::HTTP_NOT_ACCEPTED);
                }
                return redirect()->route("complete-register");
            }
        }

        // If the user is not a "Restaurant Owner" or has already fulfilled registration requirements, continue.
        return $next($request);
    }


}
