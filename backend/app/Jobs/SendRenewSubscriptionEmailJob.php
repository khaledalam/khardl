<?php

namespace App\Jobs;

use App\Enums\Admin\LogTypes;
use App\Mail\RenewSubscription;
use App\Models\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRenewSubscriptionEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    /**
     * Create a new job instance.
     */
    public function __construct(
       public $user,
       public $restaurant_name,
       public $url,
       public $period
    )
    {
       
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->user->email)->send(new RenewSubscription(
                user: $this->user,
                restaurant_name: $this->restaurant_name,
                url: $this->url,
                period: $this->period,
            ));
            $actions = [
                'en' => '[ok] An email was sent to alert the restaurant owner to renew the subscription',
                'ar' => '[تم] تم ارسال بريد لتنبيه صاحب المطعم بتجديد الاشتراك'
            ];
            Log::create([
                'user_id' => $this?->user?->id,
                'action' => $actions,
                'type' => LogTypes::RenewSubscriptionNotifySent,
                'metadata' => [
                    'email' => $this->user->email ?? null,
                ]
            ]);

        } catch (\Exception $e) {
            $actions = [
                'en' => '[fail] An email was sent to alert the restaurant owner to renew the subscription',
                'ar' => '[فشل] تم ارسال بريد لتنبيه صاحب المطعم بتجديد الاشتراك'
            ];
            Log::create([
                'action' => $actions,
                'user_id' => $this?->user?->id,
                'type' => LogTypes::RenewSubscriptionNotifyFail,
                'metadata' => [
                    'email' => $this->user->email ?? null,
                ]
            ]);
        }
    }
}
