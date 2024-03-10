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
    function sendPushNotification($target, $data, $title)
    {
        if ($target->device_token) {
            try {
                $pushService = new PushNotificationService();
                $content = [
                    'notification' => [
                        'title' => $title,
                        'data' => $data
                    ],
                    'token' => $target->device_token
                ];
                return $pushService->sendCloudMessage($content);
            } catch (\Exception $e) {
                dd($e->getMessage());
                \Sentry\captureException($e);
            }
        }
        return;
    }
}if (!function_exists('sendMultiPushNotification')) {
    function sendMultiPushNotification($data, $title, $tokens)
    {
        try {
            $pushService = new PushNotificationService();
            $content = [
                'notification' => [
                    'title' => $title,
                    'data' => $data
                ],
            ];
            return $pushService->sendMultiCloudMessage($content,$tokens);
        } catch (\Exception $e) {
            logger($e);//TODO: Send exception to sentry
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
