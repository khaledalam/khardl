<?php

namespace App\Http\Resources\API\Tenant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => $this->name,
            'photo' => $this->photo ? ($this->photo . '?ver=' . random_hash()) :  global_asset('img/category-icon.png'),
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
            $data['items'] = ItemResource::collection($this->items);
        }
        if ($request->has('lang')) {
             $data['sd']=   $request->lang;
        }
        return $data;
    }
}
