<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tenant\Tap\TapBusiness;
use Symfony\Component\HttpFoundation\Response;

class IsBusinessSubmitted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(TapBusiness::first()){
            return redirect()->route("restaurant.summary");
        }
        return $next($request);
    }
}
