<?php

namespace App\Packages\TapPayment\Controllers;

use App\Http\Controllers\Controller;
use App\Packages\TapPayment\Card\Card;
use App\Packages\TapPayment\Customer\Customer;

use App\Packages\TapPayment\Requests\CreateCardRequest;

class CardController extends Controller
{
    public function store(CreateCardRequest $request){
        return Card::create($request->validated());
    }
 
    public static function  dummy_data(){
        return [
            "card"=>[
            "number"=>4508750015741019,
                "exp_month"=>1,
                "exp_year"=>2039,
                "cvc"=>100,
                "name"=>"test user",
                "address"=>[
                  "country"=>"Kuwait",
                  "line1"=>"Salmiya, 21",
                  "city"=>"Kuwait city",
                  "street"=>"Salim",
                  "avenue"=>"Gulf"
                ]
              ],
              "client_ip"=>"192.168.1.20"
        ];
    }
    
}
