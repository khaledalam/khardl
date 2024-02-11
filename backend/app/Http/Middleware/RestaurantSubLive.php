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

        if(
        env('APP_ENV') != 'local' &&
        $request->route()->getName() != 'stancl.tenancy.asset' && 
        request()->segment(1) !=  'restaurant-style' &&
        request()->segment(1) !=  'categories' &&
        request()->segment(1) !=  'carts' 
        ){
            $sub=ROSubscription::first();
        
            if(!$sub || $sub->status != ROSubscription::ACTIVE){
                if ($request->expectsJson()) {
                    return ResponseHelper::response([
                        'message' => __('Restaurant have no active subscription yet'),
                        'is_loggedin' => false
                    ], ResponseHelper::HTTP_FORBIDDEN);
                }
                
                return redirect()->route('restaurant-not-subscribed');
            }
        }
      

        return $next($request);
    }
}
