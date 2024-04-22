<?php

namespace App\Http\Resources\API\Tenant\Collection\Driver;

use App\Http\Resources\API\Tenant\OrderResource;
use App\Http\Resources\BaseCollection;
use App\Models\Tenant\PaymentMethod;

class DriverOrderCollection extends BaseCollection
{

    public $collects = OrderResource::class;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        $completedCount = $this->collection->groupBy('status')
            ->get('completed', collect())->count();
        $onlineCashOrders = $this->collection->filter(function ($order) {
            return $order->payment_method->name === PaymentMethod::ONLINE;
        });

        $totalPaidAmount = $onlineCashOrders->sum('total');
        $CashOrders = $this->collection->filter(function ($order) {
            return $order->payment_method->name === PaymentMethod::CASH_ON_DELIVERY;
        });

        $totalUnPaidAmount = $CashOrders->sum('total');
        $rejectedCount = $this->collection->groupBy('status')
            ->get('rejected', collect())->count();
        $total = $this->collection->count();
        return [
            'completed_count' => $completedCount,
            'rejected_count' => $rejectedCount,
            'total' => $total,
            'total_paid' => $totalPaidAmount,
            'total_unpaid' => $totalUnPaidAmount,
            'start_date' => request('start_date') ?? null,
            'end_date' => request('end_date') ?? null,
            'orders' => $this->template(),
        ];
    }
}
