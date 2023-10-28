<?php

if (!function_exists('trans_json')) {
    function trans_json($value,$value_ar) {
        return [
            "en"=>$value,
            "ar"=>$value_ar,
        ];
    }
}
