<?php

namespace App\Mail;

use App\Models\NotificationReceipt;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyUsersForNewSub extends Mailable
{
    use Queueable, SerializesModels;

 
    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct(
       public $user_name,
       public $restaurant_name,
       public $restaurant_id,
       public $cost,
       public $type,
       public $date, 
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
        return $this->subject("Renew your $type")->view('emails.notify_users_for_new_sub');
    }
}
