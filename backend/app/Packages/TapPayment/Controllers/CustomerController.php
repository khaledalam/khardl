<?php

namespace App\Packages\TapPayment\Controllers;

use App\Http\Controllers\Controller;
use App\Packages\TapPayment\Customer\Customer;
use App\Packages\TapPayment\Requests\CreateCustomerRequest;
use App\Packages\TapPayment\Requests\CreateSubscriptionRequest;
use App\Packages\TapPayment\Subscription\Subscription;

class CustomerController extends Controller
{
    public function store(CreateCustomerRequest $request){
        return Customer::create($request->validated());
    }
    public function show($customer_id){
        return Customer::retrieve($customer_id);
    }
    public static function  dummy_data(){
        return [
            "first_name"=> "test",
            "middle_name"=> "test",
            "last_name"=> "test",
            "email"=> "test@test.com",
            "phone"=> [
                "country_code"=> "965",
                "number"=> "51234567"
            ],
            "description"=> "test",
            "metadata"=> [
                "sample string 1"=> "string1",
                "sample string 3"=> "string2"
            ],
            "currency"=> "KWD"
        ];
    }
    
}
