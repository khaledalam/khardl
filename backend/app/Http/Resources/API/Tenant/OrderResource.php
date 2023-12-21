<?php

namespace App\Http\Resources\API\Tenant;

use App\Models\Tenant\DeliveryType;
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
            'total'=>$this->total,
            'status'=>__('messages.'.$this->status),
            'payment_method'=>__('messages.'.$this->payment_method->name),
            'payment_status'=>__('messages.'.$this->payment_status),
            'shipping_address'=>$this->shipping_address,
            'delivery_cost'=> $this->delivery_type->cost,
            'order_notes'=>$this->order_notes,
            'platform_fee' => '',
            'delivery_type' =>__('messages.'.$this->delivery_type->name),
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,

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
