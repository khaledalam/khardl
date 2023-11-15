<?php

namespace App\Packages;

use Exception;
use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\Http;


class Msegat
{

    private static function send(string $url,array $fields){ 
        try {
            $response = Http::post(env('MSEGAT_API_URL','https://www.msegat.com/gw').$url, 
            [
                "userName"=> env("MSEGAT_USER_NAME",""),
                "apiKey"=> env("MSEGAT_API_KEY",""),
                "lang"=> ucfirst(app()->getLocale() ?? 'ar') 
            ] +   $fields

            );
            $response = json_decode($response->getBody(), true);
            if($response['code'] == 1 || $response['code'] == 'M0000'){
                return [
                    'http_code'=>ResponseHelper::HTTP_OK,
                    'message'=> $response
                ];
            }
        }catch(\Exception $e){
           logger($e->getMessage());
        }
        return [
            'http_code'=> ResponseHelper::HTTP_SERVICE_UNAVAILABLE,
            'message'=> __("Error Occur")
        ];
        
    }
    public static function sendOTP(string $userSender,string $number){
        return self::send("/sendOTPCode.php",[
            'userSender'=>$userSender,
            'number'=>$number
        ]);  
    }
   
    public static function verifyOTP(string $userSender,string $otp,?int $id){
        return self::send("/sendOTPCode.php",[
            'userSender'=>$userSender,
            'code'=>$otp,
            "id"=>$id
        ]);  
    }
}
