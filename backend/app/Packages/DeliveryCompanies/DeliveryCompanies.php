<?php

namespace App\Packages\DeliveryCompanies;

use App\Models\Tenant\DeliveryCompany;
use App\Models\Tenant\Order;
use App\Models\Tenant\RestaurantUser;
use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\StreetLine\StreetLine;
use Exception;
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

        // $deliveryCompanies = self::all();
        // $promises = false;
        // foreach($deliveryCompanies as $company)  {   
        //     $promises [] = $company->module?->assignToDriver($order,$customer);
        // }
        // if($promises){
        //     // TODO @todo save to queue 
        //     return Utils::unwrap($promises);
        // }

        $deliveryCompanies = self::all();
        $assignedCompanies = [];
        foreach($deliveryCompanies as $company)  {   
       
            try {
                if($company->module?->assignToDriver($order,$customer)){
                    $assignedCompanies[] = $company->name;
                }
            }catch(Exception $e){
                if($e->getMessage() == 'Order duplicated'){
                    if($company->module?->assignToDriver($order,$customer,true)){
                        $assignedCompanies[] = $company->name;
                        continue;
                    }
                }
                \Sentry\captureMessage(`error occur while assign $order->id to $company->name`);
                \Sentry\captureException($e);
                continue;
            }
           
        }
        //  companies that assigned to this order
        return $assignedCompanies;
    }
    public static function validateCustomerAddress(&$validator,$branchLat,$branchLng,$lat,$lng){
        $deliveryCompanies = self::all();
        if(!$deliveryCompanies->count()){
            $validator->errors()->add('distance', __("There is no delivery available for your order yet"));
            return ;
        }
        foreach($deliveryCompanies as $company){
            $distance = self::haversineDistance($branchLat, $branchLng, $lat, $lng);   
            
            if ($distance <= $company->coverage_km) {
                return true;
            }
        }
       
        $validator->errors()->add('distance', __("There is no delivery available for your order yet"));
    }
    private static function haversineDistance($branchLat, $branchLon, $lat2, $lon2)
    {
        $R = 6371; 
        $dLat = deg2rad($lat2 - $branchLat);
        $dLon = deg2rad($lon2 - $branchLon);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($branchLat)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $R * $c;

        return $distance;
    }

}
