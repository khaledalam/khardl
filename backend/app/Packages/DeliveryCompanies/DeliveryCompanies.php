<?php

namespace App\Packages\DeliveryCompanies;

use App\Models\Tenant\DeliveryCompany;
use App\Models\Tenant\Order;
use App\Models\Tenant\RestaurantUser;
use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\StreetLine\StreetLine;
use GuzzleHttp\Promise\Utils;

class DeliveryCompanies
{
    public static function all(){
        return DeliveryCompany::where('status',true)
        ->whereNotNull('module')
        ->whereNotNull('api_key')
        ->whereNotNull('api_url')
        ->get();

    }
    public static function  assign(Order $order, RestaurantUser $customer){

        $deliveryCompanies = self::all();
        $promises = false;
        foreach($deliveryCompanies as $company)  {   
            $promises [] = $company->module?->assignToDriver($order,$customer);
        }
        if($promises){
            // TODO @todo save to queue 
            return Utils::unwrap($promises);
        }
        return $promises;
    }

}
