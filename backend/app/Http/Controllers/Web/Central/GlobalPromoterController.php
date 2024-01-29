<?php

namespace App\Http\Controllers\Web\Central;

use App\Http\Controllers\Controller;
use App\Http\Services\Central\Admin\Dashboard\DashboardService;
use App\Models\Promoter;
use Illuminate\Http\Request;

class GlobalPromoterController extends Controller
{
    public function index(Request $request,$name)
    {
        $promoter = Promoter::with(['users'])->where('name', $name)->first();
        if($promoter){
            return view('global.promoters.index',compact('promoter'));
        }else{
            return redirect()->route('home');
        }
    }
}
