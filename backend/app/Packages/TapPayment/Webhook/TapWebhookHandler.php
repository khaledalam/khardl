<?php

namespace App\Packages\TapPayment\Webhook;

use Exception;
use App\Models\ROSubscription;
use App\Models\Tenant\Setting;
use App\Jobs\SendNotifyForNewSub;
use App\Repositories\Webhook\CustomerCharge;
use App\Repositories\Webhook\RestaurantCharge;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;
use App\Models\Subscription as CentralSubscription;

class TapWebhookHandler extends ProcessWebhookJob
{
    public $connection = 'sync';
    public function handle()
    {

        $data = json_decode($this->webhookCall, true)['payload'];
        if(isset($data['metadata']['subscription_id'])){ // subscription for RO
            if(isset($data['metadata']['customer_app'])){
                RestaurantCharge::updateOrCreateApp($data);
            }else if ($data['metadata']['subscription_id']){
                RestaurantCharge::updateOrCreate($data);
            }else {
                throw new Exception('Undefined subscription_id ');
                return ;
            }
            try{
                if ($data['status'] == 'CAPTURED') { 
                    if(isset($data['metadata']['coupon_code'])){
                        RestaurantCharge::updateCoupon($data);
                    }
                    RestaurantCharge::NotifyUsers($data);
                   
                }
               
            }catch(Exception $e){
                \Sentry\captureException($e);
            }
           
          
        }
        if(isset($data['metadata']['order_id'])){ // order for customer
            CustomerCharge::createOrder($data);
        }


    }
}
