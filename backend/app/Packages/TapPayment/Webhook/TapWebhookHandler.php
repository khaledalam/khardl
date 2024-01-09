<?php

namespace App\Packages\TapPayment\Webhook;

use App\Models\ROSubscription;
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

            $RO_subscription = new ROSubscription();
            $RO_subscription->chg_id  = $data['id'];
            $RO_subscription->cus_id  = $user->tap_customer_id;
            $RO_subscription->user_id = $user->id;
            $RO_subscription->start_at= now();
            $RO_subscription->end_at= now()->addYear();
            $RO_subscription->card_id  =isset($data['card']['id'])? $data['card']['id']:null;
            $RO_subscription->subscription_id  = $data['reference']['order'];
            $RO_subscription->amount  = $data['amount'];
            $RO_subscription->payment_agreement_id =isset($data['payment_agreement']['id'])?$data['payment_agreement']['id']:null;
            $RO_subscription->number_of_branches =   $data['amount'] / $central_subscription->amount;
            if($data['status'] == 'CAPTURED'){// payment successful
                $RO_subscription->status  = 'active';
            } else {
                $RO_subscription->status  = $data['status'];
            }
            $RO_subscription->save();
        }
        // TODO @todo 
        // check if business is active change the user status to be tap_verified = true
        //  send email for approved business Mail::to($user->email)->send(new ApprovedBusiness($user));

   
       
    }
}
