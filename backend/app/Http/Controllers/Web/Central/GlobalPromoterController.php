<?php

namespace App\Http\Controllers\Web\Central;

use App\Http\Controllers\Controller;
use App\Http\Services\Central\Admin\Dashboard\DashboardService;
use App\Models\Promoter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GlobalPromoterController extends Controller
{
    public const AttemptsCount = 10;
    public const PerMin = 5;
    public function index(Request $request)
    {
        if($this->haveFailedAttempts(self::AttemptsCount)){
            return redirect()->route('home');
        }
        $promoter = null;
        if ($request->name) {
            /*
                If need case sensitive
                $promoter = Promoter::where(DB::raw('BINARY `name`'),$request->name)->first();
             */
            $promoter = Promoter::where('name', $request->name)->first();
            if(!$promoter)$this->increaseFailedAttempts();
        }
        return view('global.promoters.index', compact('promoter'));
    }
    public function show(Request $request, $name)
    {
        if($this->haveFailedAttempts(self::AttemptsCount)){
            return redirect()->route('home');
        }
        $promoter = Promoter::with(['users'])->where('name', $name)->first();
        if ($promoter) {
            return view('global.promoters.show', compact('promoter'));
        } else {
            $this->increaseFailedAttempts();
            return view('global.promoters.not_found');
        }
    }
    private function haveFailedAttempts($attempts)
    {
        return  DB::table('promoters_failed_attempts')
        ->where('ip_address', request()?->ip())
        ->where('updated_at', '>=', Carbon::now()->subMinutes(self::PerMin))
        ->where('attempts','>=', $attempts)
        ->first();
    }
    public function increaseFailedAttempts()
    {
        $tenMinutesAgo = Carbon::now()->subMinutes(self::PerMin);
        $hasFailed = DB::table('promoters_failed_attempts')
            ->where('ip_address', request()?->ip())
            ->where('updated_at', '>=', $tenMinutesAgo)->first();
        if ($hasFailed) {
            DB::table('promoters_failed_attempts')->where('ip_address', request()?->ip())->update(['attempts' => DB::raw('attempts + 1')]);
        } else {
            DB::table('promoters_failed_attempts')->updateOrInsert(
                [
                    'ip_address' => request()?->ip(),
                ],
                [
                    'attempts' => 1,
                    'updated_at' => now()
                ]
            );
        }
    }
}
