<?php

namespace App\Packages\DeliveryCompanies;

use Carbon\Carbon;
use App\Models\Tenant\Order;
use App\Utils\ResponseHelper;
use GuzzleHttp\Promise\Promise;
use Illuminate\Support\Facades\Http;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\DeliveryCompany;
use App\Packages\DeliveryCompanies\DeliveryCompanyInterface;

abstract class AbstractDeliveryCompany implements DeliveryCompanyInterface
{
    protected $delivery_company;
    public function __construct(DeliveryCompany $delivery_company)
    {
        $this->delivery_company = $delivery_company;
    }
    abstract public function assignToDriver(Order $order,RestaurantUser $customer);
    
    public function send(string $url,$token,array $data,string $method = 'post'): Promise{
        if($token){
            $response = Http::async()->withToken($token)
            ->$method($url,$data);
        }else {
            $response = Http::async()->$method($url,$data);
        }
        return $response;

        // try {
        // }catch(\Exception $e){
        //    logger($e->getMessage());

        // }
        //     if($response->successful()){
        //         $response =  json_decode($response->getBody(), true);
        //         return [
        //             'http_code'=> ResponseHelper::HTTP_OK,
        //             'message'=> $response
        //         ];
        //     }
            
         
        // }catch(\Exception $e){
        //    logger($e->getMessage());
        // }
        // $response =  json_decode($response->getBody(), true);
   
        // return [
        //     'http_code'=> ResponseHelper::HTTP_BAD_REQUEST,
        //     'message'=> isset($response['message']) ?$response['message']: __("Failed to complete the process, please try again or contact Support Team")
        // ];
    }
  
}
