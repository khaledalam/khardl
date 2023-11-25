<?php

namespace App\Packages\TapPayment\Webhook;

use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class TapWebhookHandler extends ProcessWebhookJob
{
    public function handle()
    {
        $data = json_decode($this->webhookCall, true)['payload'];
        logger($data);
       
    }
}
