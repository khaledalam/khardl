<?php

namespace App\Http\Resources\API\Tenant\Collection\Driver;

use App\Http\Resources\API\Tenant\OrderResource;
use App\Http\Resources\BaseCollection;
use Modules\User\Http\Resources\Resource\ResourceResource;

class OrderCollection extends BaseCollection
{

  public $collects = OrderResource::class;

  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */

  public function toArray($request)
  {

    return $this->template();
  }
}
