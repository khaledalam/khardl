<?php

namespace App\Packages\TapPayment\Webhook;

use App\Models\ROSubscription;
use App\Repositories\Webhook\CustomerCharge;
use App\Repositories\Webhook\RestaurantCharge;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;


class TapWebhookHandler extends ProcessWebhookJob
{
    public $connection = 'sync';
    public function handle()
    {

        $data = json_decode($this->webhookCall, true)['payload'];
  
        if(isset($data['metadata']['subscription_id'])){ // subscription for RO
            RestaurantCharge::updateOrCreate($data);
        }
        if(isset($data['metadata']['order_id'])){ // order for customer
            CustomerCharge::createOrder($data);
        }
   
       
    }
}
