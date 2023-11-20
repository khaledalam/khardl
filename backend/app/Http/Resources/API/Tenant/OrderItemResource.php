<?php

namespace App\Http\Resources\API\Tenant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
            'quantity' => $this->price,
            'price' => $this->price,
        ];
        if ($request->has('item')) {
            $data['item'] = new ItemResource($this->item);
        }
        return $data;
    }
}
