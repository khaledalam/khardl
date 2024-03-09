<?php

namespace App\Http\Resources\API\Tenant\Notification;
use App\Http\Resources\BaseCollection;


class NotificationCollection extends BaseCollection
{

  public $collects = NotificationResource::class;

  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */

  public function toArray($request)
  {
    return [
      'data' => $this->collection,
      'unread_count' => getAuth()->count_unread_notifications
    ];
  }
}
