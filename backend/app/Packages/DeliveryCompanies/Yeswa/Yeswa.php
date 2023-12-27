<?php

namespace App\Packages\DeliveryCompanies\Yeswa;

use App\Packages\DeliveryCompanies\AbstractDeliveryCompany;
use App\Packages\DeliveryCompanies\DeliveryCompanyInterface;


class Yeswa  extends AbstractDeliveryCompany
{
    public function assignToDriver($order_id){
       
        return self::send(
            url: 'http://api.yeswa.net/v1/create_trip/',
            method: 'post',
            token: false,
            data: [
                "api_key"=> "string",
                "pickup_name"=> "string",
                "pickup_phone"=> "string",
                "pickup_address"=> "string",
                "pickup_latitude"=> 0,
                "pickup_longitude"=> 0,
                "pickup_time"=> "2019-08-24T14:15:22Z",
                "pickup_notes"=> "string",
                "dropoff_name"=> "string",
                "dropoff_phone"=> "string",
                "dropoff_address"=> "string",
                "dropoff_latitude"=> 0,
                "dropoff_longitude"=> 0,
                "dropoff_time"=> "2019-08-24T14:15:22Z",
                "dropoff_notes"=> "string",
                "payment_method"=> "PP",
                "order_amount"=> 0,
                "client_id"=> "string",
                "eftops"=> true
            ]
        );
        
    }

}
   