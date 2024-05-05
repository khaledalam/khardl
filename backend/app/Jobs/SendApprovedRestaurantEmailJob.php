<?php

namespace App\Jobs;

use App\Enums\Admin\LogTypes;
use App\Mail\ApprovedRestaurant;
use App\Models\Log;
use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendApprovedRestaurantEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $restaurant;

    /**
     * Create a new job instance.
     */
    public function __construct(Tenant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this?->restaurant?->user?->email)->send(
                new ApprovedRestaurant($this?->restaurant?->user, $this?->restaurant)
            );
            $action = [
                'en' => '[ok] Email sent for approve restaurant',
                'ar' => '[تم] ارسال بريد بالموافقة علي المطعم',
            ];
            tenancy()->central(function() use ($action) {
                Log::create([
                    'user_id' => $this?->restaurant?->user?->id,
                    'action' => $action,
                    'type' => LogTypes::ActivateRestaurantNotifySent,
                    'metadata' => [
                        'email' => $this->restaurant->email ?? null,
                    ]
                ]);
            });

        } catch(\Exception $e) {
            $action = [
                'en' => '[fail] Email approve restaurant',
                'ar' => '[فشل] ارسال بريد بالموافقة علي المطعم',
            ];
            tenancy()->central(function() use ($action,$e) {
                Log::create([
                    'user_id' => $this?->restaurant?->user?->id,
                    'action' => $action,
                    'type' => LogTypes::ActivateRestaurantNotifyFail,
                    'metadata' => [
                        'email' => $this->restaurant->email ?? null,
                        'e_message' => $e->getMessage(),
                    ]
                ]);
            });
        }
    }
}
