<?php

namespace App\Packages;

use Exception;
use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\Http;


class Msegat
{

    private static function credentials()
    {
        $data =  [
            "userName"=> env("MSEGAT_USERNAME",""),
            "userSender"=> env("MSEGAT_USER_SENDER",""),
            "apiKey"=> env("MSEGAT_API_KEY",""),
        ];
        return $data;
    }
    private static function send(string $url,array $fields){
        try {
            $data =  $fields  + self::credentials();
            $response = Http::post('https://www.msegat.com/gw/'.$url,$data);
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
            'http_code'=> ResponseHelper::HTTP_BAD_REQUEST,
            'message'=> __("Error Occur")
        ];

    }
    public static function sendOTP(string $number){
//        return [
//            'http_code'=>ResponseHelper::HTTP_OK,
//            'message'=> [
//                'code'=>1,
//                "message" => "Success",
//                "id" => 1234
//            ]
//        ];
        return self::send("sendOTPCode.php",[
            'number'=> $number,
            'lang'=>env('MSEGAT_LANG','En')
        ]);
    }
    public static function sendFreeOTP(string $number){


        return self::send("sendsms.php",[
            'numbers'=> $number,
            'msg'=>"Pin Code is: 1234",
            'userSender'=>'auth-mseg'
        ]);
    }
    public static function verifyOTP(string $otp,?int $id){
        return [
            'http_code'=>ResponseHelper::HTTP_OK,
            'message'=> [
                'code'=>1,
                "message" => "Success",
            ]
        ];
        return self::send("verifyOTPCode.php",[
            'code'=>$otp,
            "id"=>$id,
            'lang'=>env('MSEGAT_LANG','En')
        ]);
    }
}
