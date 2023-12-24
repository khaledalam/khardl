<?php

namespace App\Http\Controllers\API\Tenant;

use App\Models\Tenant\Order;
use App\Models\Tenant\OrderStatusLogs;
use App\Repositories\API\CustomerOrderRepository;
use Faker\Provider\id_ID\Color;
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
            if(Auth::user()?->isWorker()){
                $this->default_repository = new OrderRepository();
            } else if (!Auth::user()?->isWorker() && !Auth::user()?->isRestaurantOwner()) {
                // customer get his orders
                $this->default_repository = new CustomerOrderRepository();

            }
            return $next($request);

        });
    }

    public function logs($order, Request $request){

        $orderStatusLogs = OrderStatusLogs::all()->where('order_id', '=', $order)->sortByDesc("created_at");

        return $this->sendResponse($orderStatusLogs, __('Order status logs fetched'));
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
        $order->update(['status' => $request->status]);
        $statusLog = new OrderStatusLogs();
        $statusLog->order_id = $order->id;
        $statusLog->status = $request->status;
        switch ($request->status) {
            case Order::PENDING:
                $statusLog->class_name = 'text-warning';
                break;
            case Order::RECEIVED_BY_RESTAURANT:
                $statusLog->class_name = 'text-secondary';
                break;
            case Order::ACCEPTED:
                $statusLog->class_name = 'text-success';
                break;
            case Order::READY:
                $statusLog->class_name = 'text-info';
                break;
            case Order::CANCELLED:
                $statusLog->class_name = 'text-danger';
                break;
            case Order::COMPLETED:
                $statusLog->class_name = 'text-primary';
                break;
        }
        $statusLog->notes = $request->notes ?? null;
        $statusLog->saveOrFail();

        // Handle register order to all delivery companies
        if ($request->status == Order::RECEIVED_BY_RESTAURANT) {
            $this->delivery_companies_register_order($order);
        }

        if ($request->expectsJson()) {
            return $this->sendResponse(null, __('Order has been updated successfully.'));
        }


        return redirect()->back()->with('success',__('Order has been updated successfully.'));
    }

    private function delivery_companies_register_order(Order $order)
    {

        // @TODO


        // Get all delivery companies that registered for this restaurant

        // Send register order
    }


}
