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
        if($this->type == NotificationReceipt::is_application_purchase){
            $sub = "Customer application subscription";
        }else {
            $sub = "Restaurant subscription";
        }
        
        return $this->subject("New $sub")->view('emails.notify_users_for_new_sub', [
            'sub' => $sub,
        ]);
    }
}
