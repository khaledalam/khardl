<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     public function handle(Request $request, Closure $next, $permission)
     {
        if (!$request->user()->hasPermission($permission)) {

            if(app()->getLocale() === 'en'){

                $message = 'You are not authorized to access that page.';

                return redirect()->back()->with('error', $message);

            }
            else{
                $message = 'أنت غير مصرح لك للوصول إلى تلك الصفحة.';

                return redirect()->back()->with('error', $message);
            }
        }
    
        return $next($request);
     }

}
