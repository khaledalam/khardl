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
            'description' => $this->description,
            'availability' => $this->availability,
        ];
    }
}
