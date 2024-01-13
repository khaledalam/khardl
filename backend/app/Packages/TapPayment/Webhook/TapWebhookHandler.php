<?php

namespace App\Packages\TapPayment\Webhook;

use App\Models\ROSubscription;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;


class TapWebhookHandler extends ProcessWebhookJob
{
    public $connection = 'sync';
    public function handle()
    {
        logger("tap payment");
     
        $data = json_decode($this->webhookCall, true)['payload'];
        logger($data);
        
        if (strpos($data['id'] ?? '', 'chg') === 0) { // charge end-point
            // metadata
            if(isset($data['metadata']['subscription'])){
                if($data['metadata']['subscription'] == ROSubscription::NEW){
                    RestaurantCharge::CreateNewSubscription($data);
                }else if ($data['metadata']['subscription'] == ROSubscription::RENEW_FROM_CURRENT_END_DATE || $data['metadata']['subscription'] == ROSubscription::RENEW_TO_CURRENT_END_DATE ){
                    RestaurantCharge::RenewSubscription($data);
                }
            }
           
           
            
        }
        // TODO @todo 
        // check if business is active change the user status to be tap_verified = true
        //  send email for approved business Mail::to($user->email)->send(new ApprovedBusiness($user));
        // TODO @todo
        // delete the successful webhook calls from db
   
       
    }
}
