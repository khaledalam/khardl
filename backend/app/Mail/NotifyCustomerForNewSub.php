<?php

namespace App\Mail;

use App\Models\NotificationReceipt;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyCustomerForNewSub extends Mailable
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
            $sub = __("New application purchased");
        }else {
            $sub = __("New Restaurant subscription");
        }

        return $this->subject($sub)->view('emails.notify_users_for_new_sub', [
            'sub' => $sub,
            'user_name' => $this->user_name,
            'restaurant_name' => $this->restaurant_name,
            'restaurant_id' => $this->restaurant_id,
            'date' => $this->date,
            'cost' => $this->cost,
        ]);
    }
}
