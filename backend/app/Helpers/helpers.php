<?php
declare(strict_types=1);
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
                return substr($input, 0, -4) . ' '.__('messages.K');
            } else if ($input_count == '2') {
                return substr($input, 0, -8) . ' '.__('messages.M');
            } else if ($input_count == '3') {
                return substr($input, 0, -12) . ' '.__('messages.B');
            } else {
                return;
            }
        } else {
            return $input;
        }
    }
}
