<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * This is used to send Lead ID to TAP so that they provide use with Merchant ID for now,
 * till their API be public
 */
class TAPLeadIDToMerchantIDRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $lead_id;

    /**
     * Create a new message instance.
     *
     * @param string $lead_id
     * @return void
     */
    public function __construct($lead_id)
    {
        $this->lead_id = $lead_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(
                $address = env('KHARDL_TAP_LEAD_ID_TO_MERCHANT_ID_EMAIL', 'tap.metchants@khardl.com'),
                $name = 'Khardl TAP Merchant IDs'
            )->to([
//                env('TAP_INTEGRATIONS_EMAIL', 'integrations@tap.company')
            'khaledalam.net@gmail.com' // @TODO: remove this line
            ])
            ->cc([
                'khaledalam.net@gmail.com',
                'aldahman.ibrahim@gmail.com',
                'hassanaboeata@gmail.com'
            ])
            ->subject('Khardl | TAP Lead ID to Merchant ID request')
            ->view('emails.tap_leadid_merchantid_email');
    }
}
