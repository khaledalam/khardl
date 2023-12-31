<?php

namespace App\Packages\DeliveryCompanies\Cervo;

use App\Models\Tenant\Order;
use App\Models\Tenant\PaymentMethod;
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

    public function assignToDriver(Order $order,RestaurantUser $customer){
        $branch = $order->branch;
        if(env('APP_ENV') == 'local'){
            $token = env('CERVO_SECRET_API_KEY','');
            $data = [
                "customer"=>"Testing customer",
                "order_id"=>"Testing $order->id",
                "id"=>"TESTING $order->id",
                "lng"=>34.266593,
                "lat"=>31.279708,
                "storelat"=>31.277202,
                "storelng"=>34.268996,
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
            ];
        }
        $data += [
            "address"=>$customer->address,
            "date"=>now()->format('Y-m-d H:i:s'),
            "mobile"=>$customer->phone,
            "price"=>$order->total,
            // Available options CASH, CREDIT , ONLINE
            "payment"=> ($order->payment_method->name == PaymentMethod::CASH_ON_DELIVERY)? "CASH": "ONLINE",
            "ispaid"=> ($order->payment_method->name == PaymentMethod::CASH_ON_DELIVERY)? "NO PAID": "PAID",
            "status"=>self::STATUS_ORDER['NEW'],
            // nullable 
            "callback"=>"",
            "notes"=>"",
        ];
        return $this->send(
            url:   $this->delivery_company->api_url.'/order',
            token: $token,
            data: $data
        );
    }

}
   