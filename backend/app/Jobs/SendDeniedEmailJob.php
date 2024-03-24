<?php

namespace App\Jobs;

use App\Enums\Admin\LogTypes;
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
    protected $reasons;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, $reasons)
    {
        $this->user = $user;
        $this->reasons = $reasons;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->user->email)->queue(new DeniedEmail(
                $this->user,
                $this->reasons
            ));
            $action = [
                'en' => '[ok] Sent denied email notification',
                'ar' => '[تم] ارسال بريد بالرفض',
            ];
            tenancy()->central(function() use ($action) {
                Log::create([
                    'user_id' => $this?->user?->id,
                    'action' => $action,
                    'type' => LogTypes::DenyUserSent,
                    'metadata' => [
                        'email' => $this->user->email ?? null,
                    ]
                ]);
            });

        } catch (\Exception $e) {
            $action = [
                'en' => '[fail] Sent denied email notification',
                'ar' => '[فشل] ارسال بريد بالرفض',
            ];
            tenancy()->central(function() use ($action) {
                Log::create([
                    'action' => $action,
                    'user_id' => $this?->user?->id,
                    'type' => LogTypes::DenyUserFail,
                    'metadata' => [
                        'email' => $this->user->email ?? null,
                    ]
                ]);
            });
        }
    }
}
