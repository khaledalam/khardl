<?php

namespace App\Http\Middleware;

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
        $liveExist = DB::table('branches')->where('is_live',1)->exists();

        $user = $request->user();

        if (!$liveExist && !$user) {
            if ($request->expectsJson()) {
                return ResponseHelper::response([
                    'message' => 'Restaurant not in live mode yet',
                    'is_loggedin' => false
                ], ResponseHelper::HTTP_FORBIDDEN);
            }

            $central_url = env('APP_URL');
            $login_owner_url = route('tenant.login.owner');

            echo <<<HTML
<div style="text-align: center; height: 100vh; display: flex; flex-direction: column ; justify-content: center; align-items: center;">
<h3 style="color: red;">This Restaurant is not in live mode yet!</h3>
<br />
<a href="$login_owner_url">Go To Login Restaurant Page</a><br />
<a href="$central_url">Go To Main Khardl Website</a>
</div>
HTML;

            die;
        }
        return $next($request);
    }
}
