<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApprovedRestaurant extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $restaurant;
    public $url;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct($user,$restaurant)
    {
        $this->user = $user;
        $this->restaurant = $restaurant;
        $this->url = $this->restaurant->route('home');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Restaurant Approved')->view('emails.approved_restaurant');

    }
}