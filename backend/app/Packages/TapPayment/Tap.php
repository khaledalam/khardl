<?php

namespace App\Packages\TapPayment;

use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\Http;

class Tap
{

    public static function send(string $url,array $data,string $method = 'post',bool $withFiles = false){
        try {
            // TODO @todo change the api key to be related to restaurant not khardl
            $secret_key = env('TAP_SECRET_API_KEY','');
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
           
            logger($response);
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
        $response = json_decode((isset($response))?$response->getBody():'', true);
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
