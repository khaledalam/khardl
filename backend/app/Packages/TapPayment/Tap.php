<?php

namespace App\Packages\TapPayment;

use Exception;
use App\Utils\ResponseHelper;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Tap
{

    public static function send(string $url,array $data,string $method = 'post',bool $withFiles = false){
        try {
            $secret_key =  env('TAP_PAYMENT_TECHNOLOGY_SECRET_KEY','');
            // TODO @todo (tap) remove after make TAP_PAYMENT_TECHNOLOGY_SECRET_KEY live
            if( strpos( $url, "/merchant" ) === 0){
                $secret_key = env('TAP_PAYMENT_TECHNOLOGY_SECRET_KEY_LIVE','');
            }
            ///
            $prefix_url = env('TAP_API_URL','https://api.tap.company/v2');
            
            if($withFiles){
                $name= $data['file']->getClientOriginalName();
                $file  = file_get_contents($data['file']);
                unset($data['file']);
                $response = Http::withToken($secret_key)
                ->attach('file',$file,$name)
                ->post($prefix_url.$url,$data);
            }else {

                $response = Http::withToken($secret_key)
                ->$method($prefix_url.$url,$data);
            }
           
            if($response->successful()){
                $response = json_decode($response->getBody(), true);
                return [
                    'http_code'=>ResponseHelper::HTTP_OK,
                    'message'=> $response
                ];
            }
        }catch(\Exception $e){
           logger($e->getMessage());
        }
        $response = json_decode($response->getBody(), true);

        if(isset($response['errors'][0])){
            if(isset($response['errors'][0]['description'])){
                $errors =  $response['errors'][0]['description'];
            }else if (isset($response['errors'][0]['message'])){
                $errors =  $response['errors'][0]['message'];
            }
        }else { 
            $errors =  __("Failed to complete the process, please try again or contact Support Team");
        }
        return [
            'http_code'=> ResponseHelper::HTTP_BAD_REQUEST,
            'gateway_code'=> (isset($response['errors'][0]['code']))?$response['errors'][0]['code']: ResponseHelper::HTTP_BAD_REQUEST,
            'message'=>  $errors
        ];
    }
    public static function sendToLead(string $url,array $data,string $method = 'post',bool $withFiles = false){
        try {
            $secret_key =env('TAP_PAYMENT_TECHNOLOGY_SECRET_KEY_LIVE','');
            $prefix_url = env('TAP_API_URL','https://api.tap.company/v2');
            
            $response = Http::withToken($secret_key)
            ->$method($prefix_url.$url,$data);
            if($response->successful()){
             
                $response = json_decode($response->getBody(), true);
                logger($response);
                if(isset($response['errors'])){
                    throw new Exception("errors");
                }
                return [
                    'http_code'=>ResponseHelper::HTTP_OK,
                    'message'=> $response
                ];
            }
        }catch(\Exception $e){
           logger($e->getMessage());
        }
        if($response instanceof Response){
          $response = json_decode($response->getBody(), true);
        }
        logger($response);
        if(isset($response['errors'][0])){
            if(isset($response['errors'][0]['description'])){
                $errors =  $response['errors'][0]['description'];
            }else if (isset($response['errors'][0]['message'])){
                $errors =  $response['errors'][0]['message'];
            }
        }else { 
            $errors =  __("Failed to complete the process, please try again or contact Support Team");
        }
        return [
            'http_code'=> ResponseHelper::HTTP_BAD_REQUEST,
            'gateway_code'=> (isset($response['errors'][0]['code']))?$response['errors'][0]['code']: ResponseHelper::HTTP_BAD_REQUEST,
            'message'=>  $errors
        ];
    }

   
}
