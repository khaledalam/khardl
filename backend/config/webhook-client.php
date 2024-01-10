<?php

use App\Repositories\Webhook\WebhookSignature;
use App\Packages\TapPayment\Webhook\TapWebhookHandler;
use App\Packages\TapPayment\Webhook\TapWebhookSignature;
use App\Packages\DeliveryCompanies\Webhook\DeliveryCompaniesWebhookHandler;


return [
    'configs' => [
        [
            'name' => 'tap-payment',
            'signing_secret' => env('WEBHOOK_CLIENT_SECRET'),
            'signature_header_name' => 'Signature',
            'signature_validator' => TapWebhookSignature::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_response' => \Spatie\WebhookClient\WebhookResponse\DefaultRespondsTo::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'store_headers' => [],
            'process_webhook_job' => TapWebhookHandler::class,
        ],
        [
            'name' => 'delivery-companies',
            'signing_secret' =>  env('WEBHOOK_CLIENT_SECRET'),
            'signature_header_name' => 'Signature',
            'signature_validator' => WebhookSignature::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_response' => \Spatie\WebhookClient\WebhookResponse\DefaultRespondsTo::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'store_headers' => [],
            'process_webhook_job' => DeliveryCompaniesWebhookHandler::class,
        ],
    ],

    /*
     * The integer amount of days after which models should be deleted.
     *
     * 7 deletes all records after 1 week. Set to null if no models should be deleted.
     */
    'delete_after_days' => 30,
];
