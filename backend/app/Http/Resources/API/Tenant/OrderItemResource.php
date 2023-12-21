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
            'total' => $this->total,
            'quantity'=>$this->quantity,
            
            'notes'=>$this->notes,
            'options_price'=>$this->options_price,
            'checkbox_options'=>$this->slice_options($this->checkbox_options),
            'selection_options'=>$this->slice_options($this->selection_options),
            'dropdown_options'=>$this->slice_options($this->dropdown_options),
        ];
        if ($request->has('item')) {
            $data['item'] = new ItemResource($this->item);
        }
        return $data;
    }
    public function slice_options($data){
        $lang = (app()->getLocale() == 'ar')?0:1;
        return array_map(function ($item) use($lang){
            return array_slice($item, $lang, 1);
        }, $data);
    }
}
