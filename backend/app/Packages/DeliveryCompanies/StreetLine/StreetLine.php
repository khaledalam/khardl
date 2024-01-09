<?php

namespace App\Packages\DeliveryCompanies\StreetLine;

use App\Models\Tenant\Order;
use App\Utils\ResponseHelper;
use App\Models\Tenant\PaymentMethod;
use App\Models\Tenant\RestaurantUser;
use App\Packages\DeliveryCompanies\AbstractDeliveryCompany;



class StreetLine  extends AbstractDeliveryCompany
{
    const STATUS_ORDER = [
        'Order created' => 1,
        'Pending driver acceptance' => 2,
        'Pending order preparation' => 4,
        'Arrived to pickup' => 16,
        'Order picked up' => 6,
        'Arrived to dropoff' => 8,
        'Order delivered' => 9,
        'Order cancelled' => 10,
        'Driver acceptance timeout' => 13,
        'Driver rejected the order' => 18,
        'Order Unassigned' => 19,
        'Order failed' => 20,
    ];
    public function assignToDriver(Order $order,RestaurantUser $customer){
        $branch = $order->branch;
        if(env('APP_ENV') == 'local'){
            $token = env('STREETLINE_SECRET_API_KEY','');
            $data = [
                "pickup_lat"=>'31.952329',
                "pickup_lng"=>'35.932154',
                "lat"=>"31.9625314016",
                "lng"=>"35.8901908945",
                "address"=>"Test Address"
              
            ];
        }else {
            $token = $this->delivery_company->api_key;
            $data = [ 
                "pickup_lat"=>$branch->lat,
                "pickup_lng"=>$branch->lng,
                "lat"=>$customer->lat,
                "lng"=>$customer->lng,
                "address"=>$customer->address,

             
            ];
        }
        $data += [
            "client_order_id"=>$order->id,
            "value"=>$branch->total,
            "payment_type"=> ($order->payment_method->name == PaymentMethod::CASH_ON_DELIVERY)? "CASH": "CREDIT",
            "customer_phone"=>$customer->phone,
            "customer_name"=>$customer->fullName,
           
        
        ];
        return $this->send(
            url:   $this->delivery_company->api_url."/$token/order/add",
            token: false,
            data: $data
        );
    }
    public function addWebhook($type = 'order_updated'){
        if(env('APP_ENV') == 'local'){
            $token = env('STREETLINE_SECRET_API_KEY','');
        }else {
            $token = $this->delivery_company->api_key;
        }
        return $this->send(
            url:   $this->delivery_company->api_url."/$token/webhooks/add",
            token: false,
            data: [
                'name'=>'Webhook for update order',
                'url'=> route('webhook-client-delivery-companies'),
                'type'=>$type
            ]
        );
    }
    public static function processWebhook($payload){
        if($payload['status_id'] == self::STATUS_ORDER['Order delivered']){
                Order::findOrFail($payload['client_order_id'])->update([
                    'status'=>Order::COMPLETED
                ]);

        }else if(
            $payload['status_id'] == self::STATUS_ORDER['Arrived to pickup'] ||
            $payload['status_id'] == self::STATUS_ORDER['Order picked up'] ){
                
                Order::findOrFail($payload['client_order_id'])->update([
                    'status'=>Order::ACCEPTED
                ]);
        }else if(
            $payload['status_id'] == self::STATUS_ORDER['Order cancelled'] ||
            $payload['status_id'] == self::STATUS_ORDER['Driver acceptance timeout']  ||
            $payload['status_id'] == self::STATUS_ORDER['Driver rejected the order'] ||
            $payload['status_id'] == self::STATUS_ORDER['Order Unassigned'] || 
            $payload['status_id'] == self::STATUS_ORDER['Order failed'] ){
            // Todo @todo
            // resend the order to any delivery companies or cancelled 

        }
    }
    public function  verifyApiKey(string $api_key): bool{
        $response = $this->sendSync(
            url:   $this->delivery_company->api_url."/$api_key/webhooks/list",
            token: false,
            data: [],
            method: 'get'
        );
        return $response['http_code'] == ResponseHelper::HTTP_OK ? true : false;
    }

}
   