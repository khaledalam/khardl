<?php

namespace App\Packages\TapPayment\Customer;

use App\Models\Tenant\RestaurantUser;
use App\Utils\ResponseHelper;
use App\Packages\TapPayment\Tap;
use App\Packages\TapPayment\Customer\CustomerInterface;

class Customer extends Tap implements CustomerInterface
{
    const DEFAULT_CUSTOMER_ID = 'cus_TS03A3920231337Jw212412549';
    public static function create($data):array{
        return self::send('/customers',$data + [
            "currency"=>"SAR"
        ]);
    }
    public static function retrieve(string $customer_id): array {
        return self::send("/customers/$customer_id",[],'get');
    }
    public static function createWithModel(RestaurantUser $user) {
        if(env('APP_ENV') != 'local'){
            $customer = self::create([
                "first_name"=> $user->first_name,
                "last_name"=> $user->last_name,
                "email"=> $user->email,
                "phone"=> [
                    "country_code"=> "966",
                    "number"=> substr($user->phone, 3)
                ]
            ]);
            if($customer['http_code'] == ResponseHelper::HTTP_OK){
                $user->tap_customer_id = $customer['message']['id'];
                $user->save();
            }
        }else {
            // TODO @todo Testing only , remove after set production 
            $user->tap_customer_id = self::DEFAULT_CUSTOMER_ID;
            $user->save();  
        }
    }
}
