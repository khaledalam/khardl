<?php

namespace App\Packages\TapPayment\Webhook;


use App\Models\ROSubscription;
use App\Models\ROSubscriptionInvoice;
use App\Models\Tenant\RestaurantUser;
use App\Models\Subscription as CentralSubscription;
use Illuminate\Support\Facades\DB;
use Spatie\WebhookClient\Models\WebhookCall;
use Exception;
class RestaurantCharge
{
    public static function CreateNewSubscription($data){

        DB::beginTransaction();
        try {
            $user = RestaurantUser::where('tap_customer_id',$data['customer']['id'])->first();
            if($data['status'] == 'CAPTURED'){
                ROSubscription::create([
                    "start_at"=>  now(),
                    "end_at"=> now()->addYear(),
                    'amount'=> $data['amount'],
                    "number_of_branches"=>  $data['metadata']['n-branches'],
                    "user_id"=> $user->id,
                    'status'=> ROSubscription::ACTIVE,
                    'type'=>ROSubscription::NEW,
                    'subscription_id'=>  $data['reference']['order'],
                ]);
            }
            ROSubscriptionInvoice::create([
                'amount'=> $data['amount'],
                "number_of_branches"=>  $data['metadata']['n-branches'],
                "user_id"=> $user->id,
                'status'=> ($data['status'] == 'CAPTURED')? ROSubscription::ACTIVE:$data['status'],
                'subscription_id'=>  $data['reference']['order'],
                "chg_id"=> $data['id'],
                'cus_id'=> $user->tap_customer_id,
                'card_id'=> isset($data['card']['id'])? $data['card']['id']:null,
                'payment_agreement_id'=>isset($data['payment_agreement']['id'])?$data['payment_agreement']['id']:null,
            ]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }
     
    }
    public static function RenewSubscription($data){
        DB::beginTransaction();
        try {
            $user = RestaurantUser::where('tap_customer_id',$data['customer']['id'])->first();
            if($data['status'] == 'CAPTURED'){
                $RO_subscription=ROSubscription::first();
                if($data['metadata']['subscription'] == ROSubscription::RENEW_FROM_CURRENT_END_DATE){
                    $end_at =  $RO_subscription->end_at->addYear();
                    $amount = $data['amount'];
                }else if ($data['metadata']['subscription'] == ROSubscription::RENEW_TO_CURRENT_END_DATE){
                    $end_at   = $RO_subscription->end_at;
                    $amount =  $RO_subscription->amount + $data['amount'];
                }
                $RO_subscription->update([
                    "start_at"=> $RO_subscription->start_at,
                    "end_at"=> $end_at,
                    'amount'=> $amount,
                    "number_of_branches"=> $RO_subscription->number_of_branches +  $data['metadata']['n-branches'],
                    "user_id"=> $user->id,
                    'type'=> $data['metadata']['subscription'],
                    'status'=> ROSubscription::ACTIVE,
                    'subscription_id'=>  $data['reference']['order'],
                ]);
            }
            ROSubscriptionInvoice::create([
                'amount'=> $data['amount'],
                "number_of_branches"=>  $data['metadata']['n-branches'],
                "user_id"=> $user->id,
                'status'=> ($data['status'] == 'CAPTURED')? ROSubscription::ACTIVE:$data['status'],
                'subscription_id'=>  $data['reference']['order'],
                "chg_id"=> $data['id'],
                'cus_id'=> $user->tap_customer_id,
                'card_id'=> isset($data['card']['id'])? $data['card']['id']:null,
                'payment_agreement_id'=>isset($data['payment_agreement']['id'])?$data['payment_agreement']['id']:null,
            ]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}
