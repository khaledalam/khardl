<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use Symfony\Component\HttpFoundation\Response;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (!$user->isCustomer()) {
            if ($request->expectsJson()) {
                return ResponseHelper::response([
                    'message' => 'Forbidden access customer',
                    'is_loggedin' => true
                ], ResponseHelper::HTTP_FORBIDDEN);
            }
            return abort(403, __('Unauthorized'));
        }
        return $next($request);
    }
}
