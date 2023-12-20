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
            'status'=>$this->status,
            'payment_method'=>$this->payment_method->name,
            'payment_status'=>$this->payment_status,
            'shipping_address'=>$this->shipping_address,
            'delivery_cost'=> DeliveryType::where('id','=', $this->delivery_type_id)->first()?->cost,
            'order_notes'=>$this->order_notes,
            'platform_fee' => '',
            'delivery_type' => DeliveryType::where('id','=', $this->delivery_type_id)->first(),
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
