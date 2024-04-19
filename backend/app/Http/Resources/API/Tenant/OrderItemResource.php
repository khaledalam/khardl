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
            'price' => $this->price,
            'total' => $this->total,
            'quantity' => $this->quantity,
            'name' => $this->item?->name,
            'description' => $this->item?->description,
            'image' => $this->item?->photo,

            'notes' => $this->notes,
            'options_price' => $this->options_price,
            'checkbox_options' => $this->slice_options($this->checkbox_options),
            'selection_options' => $this->slice_options($this->selection_options),
            'dropdown_options' => $this->slice_options($this->dropdown_options),
        ];
        if ($request->has('item')) {
            $data['item'] = new ItemResource($this->item);
            $data['test'] = 'test';
        }

        return $data;
    }
    public function slice_options($data)
    {
        if (!$data)
            return null;
        $locale = app()->getLocale();
        return array_map(function ($item) use ($locale) {
            return $item[$locale];
        }, $data);
    }
}
