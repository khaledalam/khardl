<?php

namespace App\Jobs;

use App\Enums\Admin\LogTypes;
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
            $action = [
                'en' => '[ok] Sent approved email notification',
                'ar' => '[تم] ارسال بريد للموافقة',
            ];
            Log::create([
                'user_id' => $this?->user?->id,
                'action' => $action,
                'type' => LogTypes::ApproveUserSent,
               'metadata' => [
                    'email' => $this->user->email ?? null,
                ]
            ]);

        } catch (\Exception $e) {
            $action = [
                'en' => '[fail] Sent approved email notification',
                'ar' => '[فشل] ارسال بريد للموافقة',
            ];
            Log::create([
                'user_id' => $this?->user?->id,
                'action' => $action,
                'type' => LogTypes::ApproveUserFail,
               'metadata' => [
                    'email' => $this->user->email ?? null,
                ]
            ]);
        }
    }
}
