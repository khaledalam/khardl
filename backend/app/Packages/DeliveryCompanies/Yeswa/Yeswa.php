<?php

namespace App\Packages\DeliveryCompanies\Yeswa;

use App\Models\Tenant\Order;
use App\Models\Tenant\Branch;
use App\Models\Tenant\PaymentMethod;
use App\Models\Tenant\RestaurantUser;
use App\Packages\DeliveryCompanies\AbstractDeliveryCompany;


class Yeswa  extends AbstractDeliveryCompany
{
    const CORRESPOND_METHODS = [
        PaymentMethod::CASH_ON_DELIVERY=> 'COD',
        PaymentMethod::CREDIT_CARD=> 'PP',
    ];
    public function assignToDriver(Order $order,RestaurantUser $customer){
        $branch = $order->branch;
        if(env('APP_ENV') == 'local'){
            $data = [
                "api_key"=> env('YESWA_SECRET_API_KEY',''),
                "pickup_name"=> 'Test '.$branch->name,
                "dropoff_name"=> 'Test '.$customer->fullName,
                "pickup_latitude"=> 27.05,
                "pickup_longitude"=>  30.14,
                "dropoff_latitude"=>  27.05,
                "dropoff_longitude"=>  30.14,
               
            ];
        }else {
            $data = [
                "pickup_name"=>$branch->name,
                "pickup_latitude"=> $branch->lat,
                "pickup_longitude"=>  $branch->lng,
                "dropoff_name"=> $customer->fullName,
                "dropoff_latitude"=> $customer->lat,
                "dropoff_longitude"=> $customer->lng,
               
            ];
        }
        $data += [
            "api_key"=> $this->delivery_company->api_key,
            "pickup_phone"=> $branch->phone,
            "pickup_address"=> $branch->address,
            "dropoff_phone"=> $customer->phone,
            "dropoff_address"=> $customer->address,
            "order_amount"=> $order->total,
            "payment_method"=>  self::CORRESPOND_METHODS[$order->payment_method->name]  ,
            // nullable 
            // "dropoff_time"=> "",
            // "dropoff_notes"=> "",
            // "pickup_time"=> "",
            // "pickup_notes"=> "",
            // "eftops"=> true
            // "client_id"=> "",
        ];
    
        return self::send(
            url:  $this->delivery_company->api_url.'/create_trip/',
            method: 'post',
            token: false,
            data: $data
        );

    }

}
   