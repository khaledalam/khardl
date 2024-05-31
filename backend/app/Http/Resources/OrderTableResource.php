<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderTableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request) :array
    {
        return  [
            "id" =>$this->id,
            "n_of_guests" =>$this->n_of_guests,
            "branch_id" =>$this->branch_id,
            "date_time" =>$this->date_time,
            "environment" =>__($this->environment),
            "status" =>__($this->status),
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
         
        ];
    }
}
