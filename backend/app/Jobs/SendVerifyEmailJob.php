<?php

namespace App\Jobs;

use App\Models\Log;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendVerifyEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Send the email with the verification code
            Mail::send('emails.verify', ['code' => $this->user?->verification_code, 'name' => "{$this?->user?->first_name} {$this?->user?->last_name}"], function($message) {
                $message->to($this?->user?->email);
                $message->subject('Email Verification Code');
            });

            Log::create([
                'restaurant_user_email' => $this?->user?->email,
                'action' => '[ok] Sent verify restaurant user email',
            ]);

        } catch(\Exception $e) {
            Log::create([
                'restaurant_user_email' => $this?->user?->email,
                'action' => '[fail] Send verify restaurant user email',
            ]);
        }
    }
}
