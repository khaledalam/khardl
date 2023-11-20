<?php

namespace App\Http\Resources\API\Tenant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'photo' => $this->photo,
            'price' => $this->price,
            'calories' => $this->calories,
            'description' => $this->description,
            'price' => $this->price,
            'checkbox_required' =>$this->checkbox_required,
            'checkbox_input_titles' =>$this->checkbox_input_titles,
            'checkbox_input_maximum_choices' =>$this->checkbox_input_maximum_choices,
            'checkbox_input_names' =>$this->checkbox_input_names,
            'checkbox_input_prices' =>$this->checkbox_input_prices,
            'selection_required' =>$this->selection_required,
            'selection_input_names' =>$this->selection_input_names,
            'selection_input_prices' =>$this->selection_input_prices,
            'selection_input_titles' =>$this->selection_input_titles,
            'dropdown_required' =>$this->dropdown_required,
            'dropdown_input_names' =>$this->dropdown_input_names,
        ];
    }
}
