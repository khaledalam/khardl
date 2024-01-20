<?php

namespace App\Http\Controllers\Web\Central\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Services\Central\Admin\Dashboard\DashboardService;
use App\Jobs\SendTAPLeadIDMerchantIDRequestEmailJob;
use App\Mail\TAPLeadIDToMerchantIDRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller

{
    public function __construct(private DashboardService $dashboardService) {
    }
    public function index(Request $request)
    {
//        dd("test");
        SendTAPLeadIDMerchantIDRequestEmailJob::dispatch(Auth::user(), 'test');
        return $this->dashboardService->index($request);
    }
}
