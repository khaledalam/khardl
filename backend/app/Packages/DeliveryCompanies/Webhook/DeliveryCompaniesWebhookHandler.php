<?php

namespace App\Packages\DeliveryCompanies\Webhook;

use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\StreetLine\StreetLine;
use App\Packages\DeliveryCompanies\Yeswa\Yeswa;
use Illuminate\Support\Facades\Config;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class DeliveryCompaniesWebhookHandler extends ProcessWebhookJob
{
    public $connection = 'sync';
    public function handle()
    {
        logger($this->webhookCall);
        $data = json_decode($this->webhookCall, true)['payload'];
        logger($data);
        if(isset($data['delivery_company'])){
            // TODO @todo do logs or sms or notifications
            // TODO @todo send tracking url to user 
            // if(strpos($data['tracking_url'] ?? '', "https://api.streetline.app") === 0){    // the webhook coming from streetLine
            //     StreetLine::processWebhook($data);
            // }else if ($data['delivery_company'] == 'Cervo') {// the webhook coming from cervo
            //     Cervo::processWebhook($data);
            // }else if ($data['delivery_company'] == 'yeswa') {// the webhook coming from Yeswa
            //     Yeswa::processWebhook($data);
            // }
        }
       
    }
}
