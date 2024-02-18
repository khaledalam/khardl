<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalizationApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $local = ($request->hasHeader('localization'))?$request->header('localization'): app()->getLocale();
        app()->setLocale($local);

        // @TODO: remove header this. it's added to skip cors when run isolated react tenant and central apps
        return $next($request)->header('Access-Control-Allow-Origin', '*');;
    }
}
