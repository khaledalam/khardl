<?php

namespace App\Mail;

use App\Models\Tenant\RestaurantStyle;
use App\Models\Tenant\Setting;
use App\Models\Tenant\Tap\TapBusiness;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ApprovedBusiness extends Mailable
{
    use Queueable, SerializesModels;

    public $restaurant_logo;
    public $business;

    public $restaurant_name;
    public $subscription_url;
    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct(
       public $user
    )
    {
       $this->restaurant_logo = RestaurantStyle::first()->logo;
       $this->business = TapBusiness::first();
       $this->restaurant_name = Setting::first()->restaurant_name;
       $this->subscription_url = route('restaurant.service');

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Approval Business')->view('emails.approved_business');
    }
}
