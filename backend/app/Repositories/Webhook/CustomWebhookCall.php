<?php

namespace App\Repositories\Webhook;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\WebhookClient\WebhookConfig;
use Spatie\WebhookClient\Models\WebhookCall;

class CustomWebhookCall extends WebhookCall
{
    // TODO @todo  (tap) delete non exceptions rows
    protected $table ="webhook_calls";
    
    public static function storeWebhook(WebhookConfig $config, Request $request): WebhookCall
    {
        $headers = self::headersToStore($config, $request);
        DB::beginTransaction();
        return self::create([
            'name' => $config->name,
            'url' => $request->fullUrl(),
            'headers' => $headers,
            'payload' => $request->input(),
            'exception' => null,
        ]);
    }
    public function saveException(Exception $exception): self
    {
        DB::commit();
       
        $this->exception = [
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ];

        $this->save();
        \Sentry\captureException($exception);
        return $this;
    }
    

}
