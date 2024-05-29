<?php

namespace App\Http\Controllers\Web\Tenant\TableReservation;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Tenant\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\OrderTableInvoice;
use App\Http\Requests\TableReservationRequest;

class TableReservationController extends Controller
{
 
    public function index()
    {
        $tables = OrderTableInvoice::with('user','branch')->paginate(config('application.perPage')??20);
        $user= Auth::user();
        return view('restaurant.orders.tables.list', compact('tables','user'));

    }
    public function create()
    {
        $user= Auth::user();
        $customers = RestaurantUser::customers()->select('id','first_name','last_name')->get();
        $branches = Branch::Active()->select('name','id')->get();
        return view('restaurant.orders.tables.create', compact('user','branches','customers'));

    }
    public function store(TableReservationRequest $request)
    {
        OrderTableInvoice::create($request->validated());
        return redirect()->route('table-reservations.index')->with('success', __('Created successfully'));

    }
    public function validateTime(Request $request){
       return OrderTableInvoice::ValidateDateTime($request->branch_id,$request->datetime);
    }
    public function getBranchHours($branchId){
        $branch = Branch::find($branchId);

        $disabledDays = [];

        $daysOfWeek = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
    
        foreach ($daysOfWeek as $index => $day) {
            if ($branch->{$day . '_closed'}) {
                $disabledDays[] = $index;
            }
        }
    
        return response()->json([
            'disabledDays' => $disabledDays,

        ]);
    }
 
}
