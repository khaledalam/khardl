<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * This is used to send contact us form inputs to super admin email
 */
class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $email;
    public string $phone_number;
    public string $business_name;
    public string $responsible_person_name;

    /**
     * Create a new message instance.
     *
     * @param string $lead_id
     * @return void
     */
    public function __construct(
        string $email,
        string $phone_number,
        string $business_name,
        string $responsible_person_name
    )
    {
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->business_name = $business_name;
        $this->responsible_person_name = $responsible_person_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to([
               env('CONTACT_US_EMAIL')
//             'khaledalam.net@gmail.com' // @TODO: remove this line
            ])
            ->cc([
                'khaledalam.net@gmail.com',
                'aldahman.ibrahim@gmail.com',
            ])
            ->subject('Khardl | Contact Us request')
            ->view('emails.contactus_email');
    }
}
