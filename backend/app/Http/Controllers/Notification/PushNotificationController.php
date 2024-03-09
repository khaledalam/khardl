<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Http\Services\Notification\PushNotificationService;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    use APIResponseTrait;
    public function __construct(private PushNotificationService $notification)
    {
    }
    public function sendPushNotification()
    {
        $content = [
            'notification' => [
                'title' => 'Hello from Firebase (khardl)!',
                'body' => 'This is a test notification.'
            ],
            'topic' => 'global'
        ];
        return $this->notification->sendCloudMessage($content);
    }

    public function saveToken(Request $request)
    {
        $request->validate(['token' => ['required','min:1']]);
        getAuth()->update(['device_token' => $request->token]);
        return $this->sendResponse('',__('token saved successfully.'));
    }
    public function testPushNotification()
    {
        if(getAuth()->device_token){
            return sendPushNotification(getAuth(),'This is a test notification.','Hello from Firebase (khardl)!');
        }else{
            return $this->sendError('',__('No device token set'));
        }
    }
}
