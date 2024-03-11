<?php

namespace App\Http\Services\Notification;


use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
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
    public function sendMultiCloudMessage($title, $body, $data, $deviceTokens)
    {
        $messaging = $this->firebase->createMessaging();
        $message = CloudMessage::new();
        $message = $message->withNotification(Notification::create($title, $body))
        ->withData($data);
        $messaging->sendMulticast($message, $deviceTokens);
        return response()->json(['message' => 'Push notification sent successfully']);
    }
    public function sendTopicMessage($content, $topic, $tokens)
    {
        $messaging = $this->firebase->createMessaging();
        $messaging->subscribeToTopic($topic, $tokens);
        $message = CloudMessage::fromArray($content);
        $messaging->send($message);
        return response()->json(['message' => 'Push notification sent successfully']);
    }
}
