<?php

namespace App\Packages\TapPayment;

use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\Http;

class Tap
{
    protected $secret_key;
    protected $prefix_url;
    public function __construct()
    {
        $this->secret_key = env('TAP_SECRET_API_KEY','');
        $this->prefix_url = env('TAP_API_URL','https://api.tap.company/v2');
    }
    public static function send(string $url,array $data,string $method = 'post'){
        try {
            $response = Http::withToken(self::$secret_key)->$method(self::$prefix_url.$url,$data);
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
        return [
            'http_code'=> ResponseHelper::HTTP_BAD_REQUEST,
            'message'=> __("Error Occur")
        ];
    }
}
