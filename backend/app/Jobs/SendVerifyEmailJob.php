<?php

namespace App\Jobs;

use App\Enums\Admin\LogTypes;
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

    public $user;

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
            Mail::send('emails.verify', ['code' => $this->user?->verification_code, 'name' => "{$this?->user?->first_name} {$this?->user?->last_name}"], function ($message) {
                $message->to($this?->user?->email);
                $message->subject('Email Verification Code');
            });
            $action = [
                'en' => '[ok] Sent verify restaurant user email',
                'ar' => '[تم] ارسال بريد للتحقق من مستخدم المطعم',
            ];
            tenancy()->central(function() use ($action) {
                Log::create([
                    'action' => $action,
                    'user_id' => $this?->user?->id,
                    'type' => LogTypes::VerifyRestaurantUserSent,
                    'metadata' => [
                        'email' => $this->user->email ?? null,
                    ]
                ]);
            });

        } catch (\Exception $e) {

            $action = [
                'en' => '[fail] Sent verify restaurant user email',
                'ar' => '[فشل] ارسال بريد للتحقق من مستخدم المطعم',
            ];
            tenancy()->central(function() use ($action, $e) {
                Log::create([
                    'user_id' => $this?->user?->id,
                    'action' => $action,
                    'type' => LogTypes::VerifyRestaurantUserFail,
                    'metadata' => [
                        'email' => $this->user->email ?? null,
                        'e_message' => $e->getMessage()
                    ]
                ]);
            });
        }
    }
}
