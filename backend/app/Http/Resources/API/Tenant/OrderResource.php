<?php

namespace App\Http\Resources\API\Tenant;

use App\Models\Tenant\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'transaction_id' => $this->transaction_id,
            'total' => $this->total,
            'status' => $this->status,
            'payment_method' => __('' . $this?->payment_method?->name),
            'payment_status' => __('' . $this->payment_status),
            'shipping_address' => $this->shipping_address,
            'delivery_cost' => $this->delivery_type->cost,
            'order_notes' => $this->order_notes,
            'platform_fee' => '',
            'delivery_type' => __('' . $this->delivery_type->name),
            'tracking_url' => $this->tracking_url,
            'deliver_by' => $this->deliver_by,
            'driver_name' => $this->driver_name,
            'driver_phone' => $this->driver_phone,
            'cancelable' => $this->cancelable,
            'created_at' => $this->created_at,
            'received_by_restaurant_at' => $this->received_by_restaurant_at,
            'accepted_at' => $this->accepted_at,
            'updated_at' => $this->updated_at,
            'manual_order_first_name' => $this->manual_order_first_name,
            'manual_order_last_name' => $this->manual_order_last_name,
            'distance' => $this->distance,
            'own_driver_can_accept' => $this->driver_can_accept,
            'assigned_to_me' => $this->assigned_to_me,
            'time_remain_for_reject' => $this->time_remain_for_reject,
            'branch' => $this->whenLoaded('branch'),
            'customer' => $this->whenLoaded('user'),
            'driver_id' => new DriverResource($this->whenLoaded('driver')),
            'items' => OrderItemResource::collection($this->whenLoaded('items')),

        ];
        if ($request->has('branch')) {
            $data['branch'] = $this->branch;
        }
        if ($request->has('user')) {
            $data['user'] = $this->user;
        }
        if ($request->has('items')) {
            $data['items'] = OrderItemResource::collection($this->items);
        }
        return $data;
    }
}
