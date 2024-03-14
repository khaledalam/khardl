<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use App\Models\ROSubscription;
use App\Models\Tenant\Setting;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ActiveRestaurantAndBranch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if(!$user?->isRestaurantOwner() && (!Setting::first()?->is_live || ROSubscription::first()?->status != ROSubscription::ACTIVE)){
           
            if ($request->expectsJson()) {
                $user->tokens()->delete();
                return ResponseHelper::response([
                    'message' =>__( "Website doesn't have active subscription, Only restaurant owner can login"),
                    'is_loggedin' => false
                ], ResponseHelper::HTTP_NOT_AUTHENTICATED);
            }
            Auth::logout();
            return redirect()->route('login');
        }
        if(!$user?->isRestaurantOwner() && !$user->branch?->active){
           
            if ($request->expectsJson()) {
                $user->tokens()->delete();
                return ResponseHelper::response([
                    'message' =>__('Cannot login, Branch is not active'),
                    'is_loggedin' => false
                ], ResponseHelper::HTTP_NOT_AUTHENTICATED);
            }
            Auth::logout();
            return redirect()->route('login');
        }
        return $next($request);
    }
}
