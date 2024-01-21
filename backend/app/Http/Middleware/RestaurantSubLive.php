<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use App\Models\ROSubscription;
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
        if(env('APP_ENV') != 'local'){
            $sub=ROSubscription::first();
            if(!$sub|| $sub->status == ROSubscription::SUSPEND){
                if ($request->expectsJson()) {
                    return ResponseHelper::response([
                        'message' => __('Restaurant have no active subscription yet'),
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
                $message = __("Code ")." 01: ".__('messages.This Restaurant is not active, please contact web master') ;
                $khardl = __('messages.Go To Main Khardl Website');
                
                echo <<<HTML
                    <div style="text-align: center; height: 100vh; display: flex; flex-direction: column ; justify-content: center; align-items: center;">
                    <h3 style="color: red;">$message</h3>
                    <br />
                    $url
                    <a href="$central_url">$khardl</a>
                    </div>
                    HTML;
                die;
            }
        }
       
        return $next($request);
    }
}
