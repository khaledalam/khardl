<?php

namespace App\Http\Resources\API\Tenant;

use App\Models\Tenant\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id'=>$this->id,
            'name'=>$this->name,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'city'=>$this->city,
            'neighborhood'=>$this->neighborhood,
            'phone'=>$this->phone,
            'address'=>$this->address,
            'is_primary'=>$this->is_primary,
            'monday_open'=>$this->monday_open,
            'monday_close'=>$this->monday_close,
            'monday_closed'=>$this->monday_closed,
            'tuesday_open'=>$this->tuesday_open,
            'tuesday_close'=>$this->tuesday_close,
            'tuesday_closed'=>$this->tuesday_closed,
            'wednesday_open'=>$this->wednesday_open,
            'wednesday_close'=>$this->wednesday_close,
            'wednesday_closed'=>$this->wednesday_closed,
            'thursday_open'=>$this->thursday_open,
            'thursday_close'=>$this->thursday_close,
            'thursday_closed'=>$this->thursday_closed,
            'friday_open'=>$this->friday_open,
            'friday_close'=>$this->friday_close,
            'friday_closed'=>$this->friday_closed,
            'saturday_open'=>$this->saturday_open,
            'saturday_close'=>$this->saturday_close,
            'saturday_closed'=>$this->saturday_closed,
            'sunday_open'=>$this->sunday_open,
            'sunday_close'=>$this->sunday_close,
            'sunday_closed'=>$this->sunday_closed,
            'preparation_time_delivery'=>$this->preparation_time_delivery,
            'delivery_companies_option'=>$this->delivery_companies_option,
            'drivers_option'=>$this->drivers_option,
            'pickup_availability'=>$this->pickup_availability,
            'display_category_icon'=>$this->pickup_availability,

        ];
        
        return $data;
    }
}
