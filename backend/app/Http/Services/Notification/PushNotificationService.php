<?php

namespace App\Http\Services\Notification;


use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Laravel\Firebase\Facades\Firebase;
class PushNotificationService
{
    public $firebase;
    public function __construct()
    {
        $this->firebase = (new Factory)
        ->withServiceAccount(base_path() . '/config/khardl-firebase-adminsdk-jr0br-816ea052c6.json');
    }
    public function sendCloudMessage($content)
    {
        $messaging = $this->firebase->createMessaging();
        $message = CloudMessage::fromArray($content);
        $messaging->send($message);
        return response()->json(['message' => 'Push notification sent successfully']);
    }
    public function sendMultiCloudMessage($content,$deviceTokens)
    {
        $message = CloudMessage::fromArray($content);
        Firebase::messaging()->sendMulticast($message, $deviceTokens);
        return response()->json(['message' => 'Push notification sent successfully']);
    }
}
