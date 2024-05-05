<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Visitor;
use Illuminate\Support\Facades\Cache;

class Visitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $ipAddress = $request->ip();
        $cacheKey = 'visitor_' . $ipAddress . '_' . Carbon::today()->format('Ymd');
        Cache::remember($cacheKey, config('application.limit_visitor_time', 24 * 60 * 60), function () use ($ipAddress, $request, $cacheKey) {
            $todayVisitor = Visitor::whereDate('created_at', Carbon::today())->first();
            if ($todayVisitor) {
                $todayVisitor->increaseCount();
            }else{
                Visitor::create([
                    'count' => 1,
                ]);
            }
            return true;
        });
        return $next($request);
    }
}
