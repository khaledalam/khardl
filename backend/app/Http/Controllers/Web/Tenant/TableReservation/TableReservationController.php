<?php

namespace App\Http\Controllers\Web\Tenant\TableReservation;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Tenant\Branch;
use App\Http\Controllers\Controller;
use App\Rules\ValidateTableDatetime;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\OrderTableInvoice;
use App\Http\Resources\OrderTableResource;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\TableReservationRequest;
use App\Http\Requests\Web\Tenant\Order\ChangeTableStatusFormRequest;

class TableReservationController extends BaseController
{
 
    public function index( Request $request,$branchId)
    {
        $tables = OrderTableInvoice::with('user','branch')
        ->where('branch_id',$branchId)
        ->whenSearch($request['search'] ?? null)
        ->whenStatus($request['status'] ?? null)
        ->WhenDateString($request['date_string']??null)
        ->paginate(config('application.perPage')??20);
        $user= Auth::user();
        $branches = Branch::all();
        return view('restaurant.orders.tables.list', compact('branches','tables','branchId','user'));

    }
    public function create($branchId)
    {
        $user= Auth::user();
        $customers = RestaurantUser::customers()->select('id','first_name','last_name')->get();
        
        return view('restaurant.orders.tables.create', compact('user','branchId','customers'));

    }
    public function store(TableReservationRequest $request,$branchId)
    {
        $order = OrderTableInvoice::create(array_merge($request->validated(),['branch_id'=>$branchId]));
        if ($request->expectsJson()) {
            return $this->sendResponse(new OrderTableResource($order),__('Created successfully'));
        }
        return redirect()->route('table-reservations.index',['branchId'=>$branchId])->with('success', __('Created successfully'));


    }
    public function validateTime(Request $request,$branchId){
        $request->validate([
            'datetime' => ['required', 'date_format:Y-m-d H', new ValidateTableDatetime($branchId)],
        ]);
    }
    public function reservations(){
        return $this->sendResponse(OrderTableResource::collection(Auth::user()->table_reservations),__('Created successfully'));
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
    public function changeStatus(ChangeTableStatusFormRequest $request, $branchId,OrderTableInvoice $tableId)
    {
        
        $tableId->status = $request->status;
        $tableId->save();
        return redirect()->back()->with('success',__('Status changed successfully'));
    }

 
}
