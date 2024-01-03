<?php

namespace App\Jobs;

use App\Mail\DeniedEmail;
use App\Models\Log;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDeniedEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $message;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, $message = null)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->user->email)->queue(new DeniedEmail($this->user, $this->message));

            Log::create([
                'restaurant_user_email' => $this?->user?->email,
                'action' => '[ok] Sent denied email notification',
                'user_id'=> $this?->user?->id
            ]);

        } catch(\Exception $e) {
            Log::create([
                'restaurant_user_email' => $this?->user?->email,
                'action' => '[fail] Send denied email notification',
                'user_id'=> $this?->user?->id
            ]);
        }
    }
}
