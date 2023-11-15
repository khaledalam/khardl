<?php

namespace App\Packages;

use Exception;
use App\Utils\ResponseHelper;


class Msegat
{
    protected static $lang ;
    private   static $userName;
    private   static $apiKey ;
    
    public function __construct()
    {
       $this->userName = env("MSEGAT_USER_NAME","");
       $this->apiKey = env("MSEGAT_API_KEY","");
       $this->lang = ucfirst(app()->getLocale() ?? 'ar') ;
    }
    private static function send($url,$fields){ 
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, env("MSEGAT_API_URL","https://www.msegat.com/gw").$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json"
            ));
            $response = curl_exec($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);
            if($response['code'] == 1 || $response['code'] == 'M0000'){
                return [
                    'http_code'=>ResponseHelper::HTTP_OK,
                    'message'=> $response
                ];
            }
        }catch(\Exception $e){
           logger($info["http_code"]);
        }
        return [
            'http_code'=> ResponseHelper::HTTP_SERVICE_UNAVAILABLE,
            'message'=> __("Error Occur")
        ];
        
    }
    public static function sendOTP(string $userSender,string $number){
        $apiKey = self::$apiKey;
        $userName = self::$userName;
        $lang = self::$lang;

        $fields = <<<EOT
        {
            "lang": $lang
            "userName": $userName,
            "numbers": $number,
            "userSender": $userSender",
            "apiKey": $apiKey,
        }
        EOT;
        return self::send("/sendOTPCode.php",$fields);
       
    }
   
    public static function verifyOTP(string $userSender,string $otp,int $id){
        $apiKey = self::$apiKey;
        $userName = self::$userName;
        $lang = self::$lang;
        $fields = <<<EOT
        {
            "lang": $lang
            "userName": $userName,
            "code": $otp,
            "id": $id,
            "userSender": $userSender",
            "apiKey": $apiKey,
        }
        EOT;
        return self::send("/verifyOTPCode.php",$fields);
    }
}
