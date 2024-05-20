<?php

namespace App\Mail;

use App\Models\NotificationReceipt;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyUsersForNewAdsRequest extends Mailable
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
       public $package_name,
       public $price,
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
        return $this->subject(__('New Ads requested'))->view('emails.notify_users_for_new_ads_request');
    }
}
