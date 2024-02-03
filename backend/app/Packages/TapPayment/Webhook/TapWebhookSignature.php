<?php


namespace App\Packages\TapPayment\Webhook;

use Illuminate\Http\Request;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;
use Spatie\WebhookClient\WebhookConfig;

class TapWebhookSignature implements SignatureValidator
{
    public function isValid(Request $request, WebhookConfig $config): bool
    {
       
        $data = $request->all();
  
        if (strpos($data['id'] ?? '', 'chg') === 0) {  // charge end-point

            $id = $data['id'];
            $amount = $data['amount'];
            $currency = $data['currency'];
            $gateway_reference = $data['reference']['gateway'];
            $payment_reference = $data['reference']['payment'];
            $status = $data['status'];
            $created = $data['transaction']['created'];
    
            $SecretAPIKey = env('TAP_PAYMENT_TECHNOLOGY_SECRET_KEY');
    
            $toBeHashedString = 'x_id'.$id.'x_amount'.number_format($amount, 2).'x_currency'.$currency.'x_gateway_reference'.$gateway_reference.'x_payment_reference'.$payment_reference.'x_status'.$status.'x_created'.$created.'';
            
            $myHashString = hash_hmac('sha256', $toBeHashedString, $SecretAPIKey);
    
            if($myHashString == $request->header('Hashstring')){
                return true;
            }
            else{
                // logger("not passed");
                // logger($toBeHashedString);
                // logger($request->headers);
                // logger($myHashString);
                // logger($SecretAPIKey);
                return false;
            }
        }else {
            logger("error");
            return false;
        }
        
       
    }
}
