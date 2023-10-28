<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTraderRegistrationIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Check if the user is authenticated and has the "Restaurant Owner" role.
        if ($user && $user->hasRole('Restaurant Owner')) {
            // Retrieve trader registration details.
            $requirements = $user->traderRegistrationRequirement;

            // Check if the trader's registration requirements are not fulfilled.
            if (!isset($requirements) ||
                !isset($requirements->IBAN) ||
                !isset($requirements->facility_name) ||
                !isset($requirements->tax_registration_certificate) ||
                !isset($requirements->bank_certificate) ||
                !isset($requirements->identity_of_owner_or_manager) ||
                !isset($requirements->national_address)
            ) {
                return response()->json(['error' => 'Registration is incomplete. Please complete your registration.'], 403);

            }
        }

        // If the user is not a "Restaurant Owner" or has already fulfilled registration requirements, continue.
        return $next($request);
    }


}
