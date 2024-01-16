<?php

namespace App\Http\Middleware;

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

                $central_url = env('APP_URL');
                $user = $request->user();
                if($user){
                    $url_redirect = route('dashboard');
                    $url = "<a href='$url_redirect'>Go To Dashboard</a><br />";
                }else {
                    $url_redirect = route('login-trial');
                    $url = "<a href='$url_redirect'>Go To Login Restaurant Page</a><br />";
                }
            
                echo <<<HTML
                    <div style="text-align: center; height: 100vh; display: flex; flex-direction: column ; justify-content: center; align-items: center;">
                    <h3 style="color: red;">This Restaurant is not in live mode yet!</h3>
                    <br />
                    $url
                    <a href="$central_url">Go To Main Khardl Website</a>
                    </div>
                    HTML;
                die;
            }
        }
       
        return $next($request);
    }
}
