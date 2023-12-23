<?php

namespace App\Http\Middleware;

use App\Models\Tenant\Tap\TapBusiness;
use Closure;
use Illuminate\Http\Request;
use App\Models\Tenant\Tap\TapBusinessFile;
use Symfony\Component\HttpFoundation\Response;

class IsBusinessFilesSubmitted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!TapBusinessFile::first() || TapBusiness::first()){
            return redirect()->route("tap.payments_upload_tap_documents_get");
        }
        return $next($request);
    }
}
