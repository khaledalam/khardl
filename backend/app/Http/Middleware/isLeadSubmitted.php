<?php

namespace App\Http\Middleware;

use App\Models\Tenant\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isLeadSubmitted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $setting = Setting::first() ;
        if($setting->lead_id){
            return redirect()->route("restaurant.service");
        }
        return $next($request);
    }
}
