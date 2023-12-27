<?php

namespace App\Packages\DeliveryCompanies;

use App\Models\Tenant\DeliveryCompany;
use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\Http;
use App\Packages\DeliveryCompanies\DeliveryCompanyInterface;

abstract class AbstractDeliveryCompany implements DeliveryCompanyInterface
{
    protected $delivery_company;
    public function __construct()
    {
        $this->delivery_company = DeliveryCompany::
        where('status',true)
        ->where('Module',class_basename($this))
        ->whereNotNull('api_key')
        ->whereNotNull('secret_key')
        ->first();

        if(!$this->delivery_company)  {
            throw new \Exception(__(":delivery_company is not activated yet", ['delivery_company' => __(class_basename($this))]));
        } 
         
    }
    abstract public function assignToDriver($order_id);
    
    public function send(string $url,string $method = 'post',$token,array $data):array{
        try {
            if($token){
                $response = Http::withToken($token)
                ->$method($url,$data);
            }else {
                $response = Http::$method($url,$data);
            }
            if($response->successful()){
                return [
                    'http_code'=> ResponseHelper::HTTP_OK,
                    'message'=>  json_decode($response->getBody(), true)
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
