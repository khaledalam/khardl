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
        \Sentry\captureMessage('new Tenant delivery webhook');

        $data = json_decode($this->webhookCall, true)['payload'];
        // TODO @todo do logs or sms or notifications
        // TODO @todo send tracking url to user to track his order
        if(strpos($data['tracking_url'] ?? '', "https://api.streetline.app") === 0){    // the webhook coming from streetLine
            (new StreetLine)->processWebhook($data);
        }else if ($data['delivery_company'] == 'Cervo') {// the webhook coming from cervo
            (new Cervo)->processWebhook($data);
        }else if ($data['delivery_company'] == 'yeswa') {// the webhook coming from Yeswa
        (new Yeswa)->processWebhook($data);
        }

    }
}
