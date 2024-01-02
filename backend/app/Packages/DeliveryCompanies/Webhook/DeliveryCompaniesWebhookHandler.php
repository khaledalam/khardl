<?php

namespace App\Packages\DeliveryCompanies\Webhook;


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
    }
}
