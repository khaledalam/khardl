<?php

namespace App\Http\Resources\Web\Tenant;

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
            'name' => $this->name,
            'branch' => $this->branch,
            'availability' => $this->availability,
            'checkbox_required' => $this->checkbox_required,
            'checkbox_input_titles' => $this->checkbox_input_titles,
            'checkbox_input_maximum_choices'    => $this->checkbox_input_maximum_choices,
            'checkbox_input_names'  => $this->checkbox_input_names,
            'checkbox_input_prices' => $this->checkbox_input_prices,
            'selection_required'    => $this->selection_required,
            'selection_input_names' => $this->selection_input_names,
            'selection_input_prices'    => $this->selection_input_prices,
            'selection_input_titles'    => $this->selection_input_titles,
            'dropdown_required' => $this->dropdown_required,
            'dropdown_input_titles' => $this->dropdown_input_titles,
            'dropdown_input_names'  => $this->dropdown_input_names,
            'dropdown_input_prices' => $this->dropdown_input_prices,
            'price_using_loyalty_points' => $this->price_using_loyalty_points,
            'allow_buy_with_loyalty_points' => $this->allow_buy_with_loyalty_points
        ];
    }
}
