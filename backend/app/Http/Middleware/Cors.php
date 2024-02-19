<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin' , 'http://localhost:3000');
        $response->headers->set('Access-Control-Allow-Credentials' ,true);
        $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
        return $response;
    }
}
