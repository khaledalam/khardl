<?php

namespace App\Jobs;

use App\Enums\Admin\LogTypes;
use App\Mail\ApprovedBusiness;
use App\Models\Log;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAdsRequestedEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct(RestaurantUser $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->user->email)->send(new ApprovedBusiness($this->user));
            $actions = [
                'en' => '[ok] Email approve business sent successfully',
                'ar' => '[تم] تم ارسال بريد للموافقة علي الاعمال',
            ];
            tenancy()->central(function() use ($actions) {
                Log::create([
                    'user_id' => $this?->user?->id,
                    'action' => $actions,
                    'type' => LogTypes::ApproveBusinessSent,
                    'metadata' => [
                        'email' => $this->user->email ?? null,
                    ]
                ]);
            });

        } catch (\Exception $e) {
            $actions = [
                'en' => '[fail] Email approve business sent successfully',
                'ar' => '[فشل] تم ارسال بريد للموافقة علي الاعمال',
            ];
            tenancy()->central(function() use ($actions,$e) {
                Log::create([
                    'action' => $actions,
                    'user_id' => $this?->user?->id,
                    'type' => LogTypes::ApproveBusinessFail,
                    'metadata' => [
                        'email' => $this->user->email ?? null,
                        'e_message' => $e->getMessage(),
                    ]
                ]);
            });
        }
    }
}
