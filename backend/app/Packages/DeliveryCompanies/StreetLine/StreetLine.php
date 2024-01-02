<?php

namespace App\Packages\DeliveryCompanies\StreetLine;

use App\Models\Tenant\Order;
use App\Models\Tenant\PaymentMethod;
use App\Models\Tenant\RestaurantUser;
use App\Packages\DeliveryCompanies\AbstractDeliveryCompany;



class StreetLine  extends AbstractDeliveryCompany
{

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

            "value"=>$branch->total,
            "payment_type"=> ($order->payment_method->name == PaymentMethod::CASH_ON_DELIVERY)? "CASH": "CREDIT",
            "customer_phone"=>$customer->phone,
            "customer_name"=>$customer->fullName,
           
        
        ];
        return $this->send(
            url:   $this->delivery_company->api_url."/$token/order/add",
            method: 'post',
            token: false,
            data: $data
        );
    }
    public function addWebhook(){
       
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
                'type'=>'order_updated'
            ]
        );
    }

}
   