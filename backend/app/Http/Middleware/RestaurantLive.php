<?php

namespace App\Http\Middleware;

use App\Models\Tenant\RestaurantStyle;
use App\Models\Tenant\Setting;
use Closure;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RestaurantLive
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
            if (!$is_live) {
                if ($request->expectsJson()) {
                    return ResponseHelper::response([
                        'message' => __('Restaurant not in live mode yet'),
                        'is_loggedin' => false
                    ], ResponseHelper::HTTP_FORBIDDEN);
                }
                return redirect()->route('restaurant-not-live');
            }
        }
        $next = $next($request);


        // Adding R- version to invalidate and trigger fetching new style
        // on mobile side
        try {
            $restaurant_style_version = RestaurantStyle::first()?->version;
            $next->header("Restaurant-Style-Version", $restaurant_style_version);
        } catch (\Throwable $exception) {

        }

        return $next;
    }
}
