<?php

namespace App\Http\Controllers\API\Tenant;

use App\Models\Tenant\Order;
use Illuminate\Http\Request;
use App\Traits\APIResponseTrait;

use Illuminate\Support\Facades\Auth;
use App\Repositories\API\OrderRepository;
use Illuminate\Contracts\Database\Query\Builder;
use App\Http\Controllers\API\Tenant\BaseRepositoryController;
use Illuminate\Validation\Rule;


class  OrderController extends BaseRepositoryController
{
    use APIResponseTrait;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->isWorker()){
                $this->default_repository = new OrderRepository();
            }
            return $next($request);

        });
    }
    public function updateStatus($order,Request $request){

        $request->validate([
            'status' => ['required',Rule::in(Order::STATUS)],
        ]);
        $user = Auth::user();
        $order = Order::
        when($user->isWorker(), function (Builder $query, string $role)use($user) {
            $query ->where('branch_id',$user->branch->id);
        })
        ->findOrFail($order);
        $order->update(['status'=>$request->status]);
        if ($request->expectsJson()) {
            return $this->sendResponse(null, __('Order has been updated successfully.'));
        }
        return redirect()->back()->with('success',__('Order has been updated successfully.'));
    }

}
