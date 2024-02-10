<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use App\Models\ROSubscription;
use App\Models\Tenant\Setting;
use Symfony\Component\HttpFoundation\Response;

class RestaurantSubLive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if(env('APP_ENV') != 'local' &&$request->route()->getName() != 'stancl.tenancy.asset' && request()->segment(3) != 'restaurant-styles'){
            $sub=ROSubscription::first();
            $setting = Setting::first();
            if(!$sub || $sub->status != ROSubscription::ACTIVE || !$setting->lead_id || !$setting->merchant_id){
                if ($request->expectsJson()) {
                    return ResponseHelper::response([
                        'message' => __('Restaurant have no active subscription yet'),
                        'is_loggedin' => false
                    ], ResponseHelper::HTTP_FORBIDDEN);
                }
                
                return redirect()->route('restaurant-not-subscribed');
            }else {
                if(\Request::route()->getName() == 'restaurant-not-subscribed')
                    return redirect()->route('home');
            }
        // }
      

        return $next($request);
    }
}
