<?php
declare(strict_types=1);
use App\Http\Services\Notification\PushNotificationService;
use Illuminate\Support\Facades\Storage;


if (!function_exists('trans_json')) {
    function trans_json($value, $value_ar)
    {
        return [
            "en" => $value,
            "ar" => $value_ar,
        ];
    }
}

if (!function_exists('store_image')) {

    function store_image($image, $store_at, $name = null)
    {
        try {

            if ($name) {
                $filename = $name . '.' . $image->guessExtension();
                if (Storage::disk('public')->exists($store_at . '/' . $filename)) {
                    Storage::delete($store_at . '/' . $filename);
                }
            } else {
                $filename = uniqid() . '.' . $image->guessExtension();
            }
            $image->storeAs($store_at, $filename, 'public');
            return $store_at . '/' . $filename;
        } catch (Exception $e) {
            return null;
        }


    }
}
if (!function_exists('getAmount')) {
    function getAmount($input)
    {
        $input = number_format($input);
        $input_count = substr_count($input, ',');
        if ($input_count != '0') {
            if ($input_count == '1') {
                return substr($input, 0, -2) . ' '.__('K');
            } else if ($input_count == '2') {
                return substr($input, 0, -6) . ' '.__('M');
            } else if ($input_count == '3') {
                return substr($input, 0, -10) . ' '.__('B');
            } else {
                return;
            }
        } else {
            return $input;
        }
    }
}
if (!function_exists('sendPushNotification')) {
    function sendPushNotification($target, $data, $title, $body, $type, $place = 'both')
    {
        if ($target->device_token) {
            try {
                $pushService = new PushNotificationService();
                $readyData = [
                    'type' => $type,
                    'place' => $place,
                ];
                $notificationData = [
                    'title' => $title,
                    'body' => $body,
                ];
                $androidSound = [
                    'notification' => [
                        'channel_id' => 'khrdl_create_order',
                        'sound' => 'bell2',
                    ]
                ];
                $appleSound = [
                    'headers' => [
                        'apns-priority' => '10'
                    ],
                    'payload' => [
                        'aps' => [
                            'sound' => 'bell2.mp3'
                        ]
                    ]
                ];
                $data = array_merge($data, $readyData, $notificationData);
                if($place == 'both' || $place == 'external'){
                    $content = [
                        'notification' => $notificationData,
                        'token' => $target->device_token,
                        'data' => $data,
                        'android' => $androidSound,
                        'apns' => $appleSound
                    ];
                }else{
                    $content = [
                        'token' => $target->device_token,
                        'data' => $data
                    ];
                }
                return $pushService->sendCloudMessage($content);
            } catch (\Exception $e) {
                \Sentry\captureException($e);
            }
        }
        return;
    }
}
if (!function_exists('sendMultiPushNotification')) {
    function sendMultiPushNotification($data, $title, $body, $tokens, $type, $place = 'both')
    {
        $readyData = [
            'type' => $type,
            'place' => $place,
        ];
        $notificationData = [
            'title' => $title,
            'body' => $body,
        ];
        $data = array_merge($data, $readyData, $notificationData);
        try {
            $pushService = new PushNotificationService();
            return $pushService->sendMultiCloudMessage($title, $body, $data, $tokens);
        } catch (\Exception $e) {
            \Sentry\captureException($e);
        }
        return;
    }
}
if (!function_exists('SendTopicMessage')) {
    function SendTopicMessage($data, $title, $body, $tokens, $type, $topic = 'internal')
    {
        $readyData = [
            'type' => $type,
            'place' => $topic,
        ];
        $notificationData = [
            'title' => $title,
            'body' => $body,
        ];
        $data = array_merge($data, $readyData, $notificationData);
        try {
            $pushService = new PushNotificationService();
            $content = [
                'notification' => [
                    $notificationData
                ],
                'data' => $data,
                'topic' => $topic
            ];
            return $pushService->sendTopicMessage($content, $topic, $tokens);
        } catch (\Exception $e) {
            \Sentry\captureException($e);
        }
        return;
    }
}
if (!function_exists('getAuth')) {
    function getAuth()
    {
      return auth('sanctum')->user();
    }
}
