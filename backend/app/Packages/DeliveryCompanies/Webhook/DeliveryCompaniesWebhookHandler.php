<?php

namespace App\Packages\DeliveryCompanies\Webhook;


use App\Packages\DeliveryCompanies\StreetLine\StreetLine;
use Illuminate\Support\Facades\Config;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class DeliveryCompaniesWebhookHandler extends ProcessWebhookJob
{
    public $connection = 'sync';
    public function handle()
    {
        logger($this->webhookCall);
        $data = json_decode($this->webhookCall, true)['payload'];
        if($data){
            // TODO @todo do logs or sms or notifications
          
            if(isset($data['client_order_id'])){   // the webhook coming from streetLine
                StreetLine::processWebhook($data);
            }
            
        }
       
    }
}
