<?php

namespace App\Packages\TapPayment\Webhook;

use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class TapWebhookHandler extends ProcessWebhookJob
{
    public function handle()
    {
        logger($this->webhookCall);
        $data = json_decode($this->webhookCall, true)['payload'];
        // TODO @todo 
        // check if business is active change the user status to be tap_verified = true
        //  send email for approved business Mail::to($user->email)->send(new ApprovedBusiness($user));

        logger($data);
       
    }
}
