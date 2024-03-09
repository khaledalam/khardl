<?php

namespace App\Http\Controllers\API\Tenant\Notification;


use App\Http\Resources\API\Tenant\Notification\NotificationCollection;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
  use APIResponseTrait;

  public function index(Request $request)
  {
    $user = getAuth();
    $notifications = $user->notifications()->orderByDesc('created_at')->paginate($request['perPage'] ?? config('application.perPage'));
    return $this->sendResponse(new NotificationCollection($notifications));
  }

  public function show($id)
  {
    $user = getAuth();

    $notification = $user->notifications()->findOrFail($id);
    $notification->markAsRead();

    return $this->sendResponse(['unread_count' => $user->count_unread_notifications], 'Done');
  }

  public function markAllAsRead()
  {
    $user = getAuth();

    $user->notifications()->where('read_at', null)->get()->markAsRead();
    return $this->sendResponse([], 'Done');
  }
  public function toggleNotification()
  {
    $user = getAuth();

    $user->update(['enable_notification' => !$user->enable_notification]);
    return $this->sendResponse([
        'enable_notification' => $user->enable_notification
    ], 'Done');
  }

 /*  public function authenticate(Request $request)
  {
    $request->validate([
        'socket_id' => ['required'],
        'channel_name' => ['required'],
    ]);
    $pusher = new PusherService();
    return $pusher->authenticate($request, getAuth());
  } */
}
