<?php

namespace App\Packages\TapPayment\Controllers;

use App\Http\Controllers\Controller;
use App\Packages\TapPayment\Requests\CreateSubscriptionRequest;
use App\Packages\TapPayment\Subscription\Subscription;

class SubscriptionController extends Controller
{
    public function store(CreateSubscriptionRequest $request){
        return Subscription::create($request->validated());
    }
    public function show($subscription_id){
        return Subscription::retrieve($subscription_id);
    }
    public static function dummy_data(){
        return [
            'term' => [
                'interval' => 'MONTHLY',
                'period' => 10,
                'from' => '2023-06-24t08:42:02',
                'due' => 0,
                'auto_renew' => true,
                'timezone' => 'Asia/Kuwait',
            ],
            'trial' => [
                'days' => 2,
                'amount' => 0.1,
            ],
            'charge' => [
                'amount' => 1,
                'currency' => 'KWD',
                'description' => 'Test',
                'statement_descriptor' => 'Sample',
                'metadata' => [
                    'udf1' => 'test 1',
                    'udf2' => 'test 2',
                ],
                'receipt' => [
                    'email' => 'false',
                    'sms' => 'true',
                ],
                'customer' => [
                    'id' => 'cus_Qe243220191752o5L21002551',
                ],
                'source' => [
                    'id' => 'card_KhvrE5MgXCsSe72oyHGWkVI6',
                ],
            ],
        ];
    }
    
}
