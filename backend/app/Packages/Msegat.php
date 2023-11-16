<?php

namespace App\Packages;

use Exception;
use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\Http;


class Msegat
{

    private static function send(string $url,array $fields){ 
        try {
            $data =  [
                "userName"=> env("MSEGAT_USERNAME",""),
                "userSender"=> env("MSEGAT_USER_SENDER",""),
                "apiKey"=> env("MSEGAT_API_KEY",""),
                "lang"=> ucfirst(app()->getLocale() ?? 'ar') 
            ] +   $fields;
            if(env('APP_ENV') == 'local'){
                $data['userSender'] = 'auth-mseg';
                $data['msg'] = "Pin Code is: 1234";
            }
            $response = Http::post('https://www.msegat.com/gw'.$url,$data);
            
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
    public static function sendOTP(string $number){
        return self::send("/sendOTPCode.php",[
            'number'=>$number
        ]);  
    }
   
    public static function verifyOTP(string $otp,?int $id){
        return self::send("/sendOTPCode.php",[
            'code'=>$otp,
            "id"=>$id
        ]);  
    }
}
