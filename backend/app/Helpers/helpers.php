<?php
declare(strict_types=1);
use App\Http\Services\Notification\PushNotificationService;
use App\Models\Tenant;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

if (!function_exists('generate_token')) {
    function generateToken($length = 5)
    {
//        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // 35 ^ 5 => 52,521,875
        $characters = '0123456789'; // 10 ^ 5 => 100,000
        $token = '';
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return strtoupper($token);
    }
}

if (!function_exists('trans_json')) {
    function trans_json($value, $value_ar)
    {
        return [
            "en" => $value,
            "ar" => $value_ar,
        ];
    }
}

if (!function_exists('last_git_commit_hash')) {

    function last_git_commit_hash()
    {
        return trim(exec('git log --pretty="%h" -n1 HEAD'));
    }
}

if (!function_exists('random_hash')) {

    function random_hash($len = 6)
    {
        return bin2hex(random_bytes($len));
    }
}



if (!function_exists('store_image')) {

    function store_image($image, $store_at, $name = null, $old_image = null)
    {
        if($old_image){//Try to delete old image of exist
            try {
                $oldImageFilename = basename(parse_url($old_image, PHP_URL_PATH));
                if (Storage::disk('public')->exists($store_at . '/' . $oldImageFilename)) {
                    Storage::disk('public')->delete($store_at . '/' . $oldImageFilename);
                }
            } catch (\Exception $e) {
                \Sentry\captureException($e);
            }
        }
        try {
            if($name){
                $filename = $name . '.' . $image->getClientOriginalExtension();
            }else{
                $filename = Str::random(40) . '.' . $image->getClientOriginalExtension();
            }
            while (Storage::disk('public')->exists('items/' . $filename)) {
                $filename = Str::random(40) . '.' . $image->getClientOriginalExtension();
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

if (!function_exists('getTenantByHash')) {
    function getTenantByHash(string $hash)
    {
        return Cache::rememberForever($hash, function() use($hash) {
            return Tenant::all()->where('mapper_hash', '=', $hash)->first();
        });
    }
}
if (!function_exists('haversineDistance')) {
    function haversineDistance($lat1, $long1, $lat2, $lon2)
    {
        $R = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $long1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $R * $c;

        return $distance;
    }
}

if (!function_exists('getTenantByOrderId')) {
    function getTenantByOrderId(string $orderid)
    {
        if (strlen($orderid) < 5) {
            return null;
        }
        $tenant_hash = substr($orderid, 0, 5);

        $tenant = getTenantByHash($tenant_hash);

        return $tenant;

        return Cache::remember($orderid, 100, function() use($tenant) {
            return $tenant;
        });
    }
}

