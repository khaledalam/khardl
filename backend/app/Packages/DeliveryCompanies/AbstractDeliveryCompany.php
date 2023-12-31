<?php

namespace App\Packages\DeliveryCompanies;

use App\Models\Tenant\Order;
use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\Http;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\DeliveryCompany;
use App\Packages\DeliveryCompanies\DeliveryCompanyInterface;
use Carbon\Carbon;

abstract class AbstractDeliveryCompany implements DeliveryCompanyInterface
{
    protected $delivery_company;
    public function __construct()
    {
        $this->delivery_company = DeliveryCompany::
        where('status',true)
        ->where('Module',class_basename($this))
        ->whereNotNull('api_key')
        ->whereNotNull('api_url')
        ->first();

        if(!$this->delivery_company)  {
            throw new \Exception(__(":delivery_company is not activated yet", ['delivery_company' => __(class_basename($this))]));
        } 
         
    }
    abstract public function assignToDriver(Order $order,RestaurantUser $customer);
    
    public function send(string $url,$token,array $data,string $method = 'post'):array{
        try {
            // dd($url,$method,$data,$token);
            if($token){
                $response = Http::withToken($token)
                ->$method($url,$data);
            }else {
                $response = Http::$method($url,$data);
            }
           
            if($response->successful()){
                $response =  json_decode($response->getBody(), true);
                return [
                    'http_code'=> ResponseHelper::HTTP_OK,
                    'message'=> $response
                ];
            }
            
         
        }catch(\Exception $e){
           logger($e->getMessage());
        }
        $response =  json_decode($response->getBody(), true);
   
        return [
            'http_code'=> ResponseHelper::HTTP_BAD_REQUEST,
            'message'=> isset($response['message']) ?$response['message']: __("Failed to complete the process, please try again or contact Support Team")
        ];
    }
  
}
