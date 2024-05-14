<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeniedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $reasons;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $reasons)
    {
        $this->user = $user;
        $this->reasons = $reasons;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('Reupload following documents'))->view('emails.denied_email',[
            'user' => $this->user,
            'reasons' => $this->reasons,
        ]);

    }
}
