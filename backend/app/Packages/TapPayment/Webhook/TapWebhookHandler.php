<?php

namespace App\Packages\TapPayment\Webhook;

use App\Models\ROSubscription;
use App\Models\ROSubscriptionInvoice;
use App\Models\Tenant\RestaurantUser;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;
use App\Models\Subscription as CentralSubscription;

class TapWebhookHandler extends ProcessWebhookJob
{
    public $connection = 'sync';
    public function handle()
    {
        logger("tap payment");
        // @todo validate webhook
        $data = json_decode($this->webhookCall, true)['payload'];
       
        if (strpos($data['id'] ?? '', 'chg') === 0) { // charge end-point
            $user = RestaurantUser::where('tap_customer_id',$data['customer']['id'])->first();
            $central_subscription = tenancy()->central(function()use($data){
                return CentralSubscription::find($data['reference']['order']);
            });

            ROSubscription::create([
                "start_at"=>  now(),
                "end_at"=> now()->addYear(),
                'amount'=> $data['amount'],
                "number_of_branches"=>  $data['amount'] / $central_subscription->amount,
                "user_id"=> $user->id,
                'status'=> ($data['status'] == 'CAPTURED')? ROSubscription::ACTIVE:$data['status'],
                'subscription_id'=>  $data['reference']['order'],
            ]);
            ROSubscriptionInvoice::create([
                'amount'=> $data['amount'],
                "number_of_branches"=>  $data['amount'] / $central_subscription->amount,
                "user_id"=> $user->id,
                'status'=> ($data['status'] == 'CAPTURED')? ROSubscription::ACTIVE:$data['status'],
                'subscription_id'=>  $data['reference']['order'],
                "chg_id"=> $data['id'],
                'cus_id'=> $user->tap_customer_id,
                'card_id'=> isset($data['card']['id'])? $data['card']['id']:null,
                'payment_agreement_id'=>isset($data['payment_agreement']['id'])?$data['payment_agreement']['id']:null,
            ]);
        }
        // TODO @todo 
        // check if business is active change the user status to be tap_verified = true
        //  send email for approved business Mail::to($user->email)->send(new ApprovedBusiness($user));

   
       
    }
}
