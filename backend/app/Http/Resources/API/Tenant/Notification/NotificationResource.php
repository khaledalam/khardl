<?php

namespace App\Http\Resources\API\Tenant\Notification;


use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */

  public function toArray($request)
  {
    return [
      'id'             => $this->id,
      'data'          => $this->data,
      'read_at'          => (string)$this->read_at,
      'created_at'          => $this->created_at,
    ];
  }
}
