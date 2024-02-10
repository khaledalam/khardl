<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use App\Models\ROSubscription;
use App\Models\Tenant\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RestaurantNotLive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if(env('APP_ENV') != 'local'){
            $is_live = Setting::first()->is_live;
            if ($is_live && ROSubscription::where('status',ROSubscription::ACTIVE)->first()) {
                if ($request->expectsJson()) {
                    return ResponseHelper::response([
                        'message' => __('Restaurant is in a live mode'),
                        'is_loggedin' => false
                    ], ResponseHelper::HTTP_FORBIDDEN);
                }
                return redirect()->back();
            }
           
        }    
            
        
        return $next($request);
    }
}
