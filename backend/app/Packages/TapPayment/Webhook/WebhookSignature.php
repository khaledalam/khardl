<?php


namespace App\Packages\TapPayment\Webhook;

use Illuminate\Http\Request;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;
use Spatie\WebhookClient\WebhookConfig;

class WebhookSignature implements SignatureValidator
{
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        return true;
        // TODO @todo validate the coming request after finished the integration
        // $myHashString = hash_hmac('sha256', $request->header('hashstring'), env('TAP_SECRET_API_KEY'));
        // if($myHashString ){
        //     return false;
        // }
        // return false;
    }
}
