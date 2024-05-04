<?php

namespace App\Mail;

use App\Models\ROCustomerAppSub;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationsIsReadyMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct(
       public ROCustomerAppSub $rOCustomerAppSub,
    )
    {


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Your app is published and ready now.")->view('emails.customer_app_is_ready', [
            'app' => $this->rOCustomerAppSub,
        ]);
    }
}
