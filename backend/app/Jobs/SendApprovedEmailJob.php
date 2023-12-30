<?php

namespace App\Jobs;

use App\Mail\ApprovedEmail;
use App\Models\Log;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendApprovedEmailJob implements ShouldQueue
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
            // Send approved email notification
            Mail::to($this->user->email)->send(new ApprovedEmail($this->user));

            Log::create([
                'restaurant_user_email' => $this?->user?->email,
                'action' => '[ok] Sent approved email notification',
            ]);

        } catch(\Exception $e) {
            Log::create([
                'restaurant_user_email' => $this?->user?->email,
                'action' => '[fail] Send approved email notification',
            ]);
        }
    }
}
