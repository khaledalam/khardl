<?php

namespace App\Packages\DeliveryCompanies\Cervo;

use App\Models\Tenant\Order;
use App\Utils\ResponseHelper;
use App\Models\Tenant\PaymentMethod;
use Illuminate\Support\Facades\Http;
use App\Models\Tenant\RestaurantUser;
use App\Packages\DeliveryCompanies\AbstractDeliveryCompany;



class Cervo  extends AbstractDeliveryCompany
{
    const STATUS_ORDER = [
        1=>'NEW',
        0=>'CANCELLED',
        2=>'ACCEPTED_BY_DRIVER',
        3=>'ORDER_ON_HAND',
        4=>'COMPLETED',
        5=>'CANCELED_BY_DRIVER',
        'CANCELLED'         =>0,
        'ACCEPTED_BY_DRIVER'=>2,
        'NEW'               =>1,
        'ORDER_ON_HAND'     =>3,
        'COMPLETED'         =>4,
        'CANCELED_BY_DRIVER'=>5,
    ];

    public function assignToDriver(Order $order,RestaurantUser $customer):bool{
        $branch = $order->branch;

        if(env('APP_ENV') == 'local'){
            $token = env('CERVO_SECRET_API_KEY','');
            $data = [
                "customer"=>"Testing customer",
                "order_id"=>"Testing 4$order->id",
                "id"=>"Testing 4$order->id",
                "lng"=>34.266593,
                "lat"=>31.279708,
                "storelat"=>31.277202,
                "storelng"=>34.268996,
                "address"=>'Testing address'
            ];
        }else {
            $token = $this->delivery_company->api_key;
            $data = [
                "customer"=>$customer->address ,
                "order_id"=>$order->id,
                "id"=>$order->id,
                "lng"=>$customer->lat,
                "lat"=> $customer->lng,
                "storelat"=>$branch->lat,
                "storelng"=>$branch->lng,
                "address"=>$customer->address,
            ];
        }
        $data += [

            "date"=>now()->format('Y-m-d H:i:s'),
            "mobile"=>$customer->phone,
            "price"=>$order->total,
            // Available options CASH, CREDIT , ONLINE
            "payment"=> ($order->payment_method->name == PaymentMethod::CASH_ON_DELIVERY)? "CASH": "ONLINE",
            "ispaid"=> ($order->payment_method->name == PaymentMethod::CASH_ON_DELIVERY)? "NO PAID": "PAID",
            "status"=>self::STATUS_ORDER['NEW'],
            // nullable
            "callback"=>route('webhook-client-delivery-companies'),
            "notes"=>"",
        ];

        $response = $this->sendSync(
            url:   $this->delivery_company->api_url.'/order',
            token: $token,
            data: $data
        );
        if($response['http_code'] == ResponseHelper::HTTP_OK){
            $order->update([
                'cervo_ref'=>$response['message']
            ]);
            return true;
        }else {
            return false;
        }
     
    }
    public function cancelOrder($id): bool{
        try {   
            if(env('APP_ENV') == 'local'){
                $token = env('CERVO_SECRET_API_KEY','');
            }else {
                $token = $this->delivery_company->api_key;
            }
            $response = $this->sendSync(
                url: $this->delivery_company->api_url . '/cancelorder',
                token: $token,
                data:  [],  
                method: 'get'
            );
            return $response['http_code'] == ResponseHelper::HTTP_OK ? true : false;
        } catch (\Exception $e) {
            logger($e->getMessage());
            return false;
        }
    }
    public function processWebhook($payload){
        if(isset($payload["order_status"])  ){

            $order = Order::where('cervo_ref',$payload['order_id'])->first();

            if(!$order->deliver_by || $order->deliver_by == class_basename(static::class)){
  
                if($payload['tracking']){
                    $order->update([
                        'tracking_url'=> $payload['tracking']
                    ]); 
                }
                if($payload["order_status"]  == self::STATUS_ORDER['ACCEPTED_BY_DRIVER']){
                    $order->update([
                        'status'=>Order::ACCEPTED,
                        'deliver_by'=> class_basename(static::class),
                    ]);
                    $this->cancelOtherOrders("cervo",$order); 
                   
                }else if($payload['order_status'] == self::STATUS_ORDER['COMPLETED']){
                    $order->update([
                        'status'=>Order::COMPLETED
                    ]);
                }else if (
                    $payload['order_status'] == self::STATUS_ORDER['CANCELLED']){
                    // Todo @todo
                    $order->update([
                        'status'=>Order::CANCELLED
                    ]);
                }
            }
        }

    }
    public function  verifyApiKey(string $api_key): bool{

        try {
            $response = Http::withToken($api_key)
                ->get($this->delivery_company->api_url . '/order/RANDOM_ID_NOT_EXISTS', []);

            if ($response->getStatusCode() == 400) {
                return true;
            } else {
                // 401 Unauthorized
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
    // public function getOrder($id){
    //     if(env('APP_ENV') == 'local'){
    //         $token = env('CERVO_SECRET_API_KEY','');
    //     }else {
    //         $token = $this->delivery_company->api_key;
    //     }
    //     try {
    //         $response = Http::withToken($token)
    //         ->get($this->delivery_company->api_url."/order/$id");
    //         $response =  json_decode($response->getBody(), true);
    //         return $response['Status'];
    //     }catch(\Exception $e){
    //         logger($e->getMessage());
    //         return false;
    //     }

    // }
}
