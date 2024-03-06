<?php

namespace App\Packages\DeliveryCompanies;

use Carbon\Carbon;
use App\Models\Tenant\Order;
use App\Utils\ResponseHelper;
use GuzzleHttp\Promise\Promise;
use Illuminate\Support\Facades\Http;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\DeliveryCompany;
use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\StreetLine\StreetLine;
use App\Packages\DeliveryCompanies\DeliveryCompanyInterface;
use App\Packages\DeliveryCompanies\Yeswa\Yeswa;
use Exception;

abstract class AbstractDeliveryCompany implements DeliveryCompanyInterface
{
    protected $delivery_company;
    public function __construct()
    {
        $this->delivery_company = DeliveryCompany::where('module',class_basename($this))->firstOrFail();
    }
    abstract public function assignToDriver(Order $order,RestaurantUser $customer,$duplicated = false):bool | Exception;
    abstract public function verifyApiKey(string $api_key): bool;
    abstract public function cancelOrder($id): bool;
    abstract public function processWebhook(array $payload);

   
    public function send(string $url,$token,array $data,string $method = 'post'): Promise{
        if($token){
            $response = Http::async()->withToken($token)
            ->$method($url,$data);
        }else {
            $response = Http::async()->$method($url,$data);
        }
        
        return $response;

      
    }
    public function sendSync(string $url,$token,array $data,string $method = 'post'): array{
        try {
   
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
           
        }
        $response =  json_decode($response->getBody(), true);
        logger($response);
        return [
            'http_code'=> ResponseHelper::HTTP_BAD_REQUEST,
            'message'=> isset($response['message']) ?$response['message']: __("Failed to complete the process, please try again or contact Support Team")
        ];
    }
    public function cancelOtherOrders($module,Order $order){
        // if($module != 'streetline' && $order->streetline_ref){
        //     (new StreetLine())->cancelOrder($order->streetline_ref);
        // }
        if($module != 'cervo' && $order->cervo_ref){
            (new Cervo())->cancelOrder($order->cervo_ref);
        }
        if($module != 'yeswa' && $order->yeswa_ref){
            (new Yeswa())->cancelOrder($order->yeswa_ref);
        }
        
    }
}
