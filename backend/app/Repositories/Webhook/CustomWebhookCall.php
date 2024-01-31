<?php

namespace App\Repositories\Webhook;

use Spatie\WebhookClient\Models\WebhookCall;

class CustomWebhookCall extends WebhookCall
{
    // TODO @todo  (tap) delete non exceptions rows
    
    // public function clearException(): self
    // {
    //     logger("exception delete");
    //     $this->delete();

    //     return new \App\Repositories\Webhook\CustomWebhookCall();
    // }
    
}
