<?php

namespace App\Packages\TapPayment;

use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\Http;

class Tap
{

    public static function send(string $url,array $data,string $method = 'post'){
        try {
            $secret_key = env('TAP_SECRET_API_KEY','');
            $prefix_url = env('TAP_API_URL','https://api.tap.company/v2');
            $response = Http::withToken($secret_key)
            ->$method($prefix_url.$url,$data);
            
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
        return [
            'http_code'=> ResponseHelper::HTTP_BAD_REQUEST,
            'gateway_code'=> (isset($response['errors']))?$response['errors'][0]['code']: ResponseHelper::HTTP_BAD_REQUEST,
            'message'=> (isset($response['errors']))?$response['errors'][0]['error']: __("Error Occur")
        ];
    }
   
}
