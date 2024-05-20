<?php

namespace App\Jobs;

use App\Enums\Admin\LogTypes;
use App\Mail\NotifyUsersForNewAdsRequest;
use App\Models\Log;
use App\Models\NotificationReceipt;
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
    public function __construct(
        public $restaurant_name,
        public $package_name,
        public $price,

    ) {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            tenancy()->central(function () {
                $users = NotificationReceipt::where('active', true)->where(NotificationReceipt::is_ads_requests, true)->get();
                foreach ($users as $user) {
                    Mail::to($user->email)->send(
                        new NotifyUsersForNewAdsRequest(
                            $user->name,
                            $this->restaurant_name,
                            $this->package_name,
                            $this->price,

                        )
                    );
                    $actions = [
                        'en' => "[ok] email has been successfully sent alerting admins of a request to purchase an advertising package",
                        'ar' => "[تم] إرسال بريد إلكتروني بنجاح لتنبيه المسؤولين عن طلب شراء باقة إعلانية"
                    ];

                    Log::create([
                        'user_id' => null,
                        'action' => $actions,
                        'type' => LogTypes::RORequestForAdsSent,
                        'metadata' => [
                            'email' => $user->email ?? null,
                            'name' => $user->full_name ?? null,
                        ]
                    ]);
                }

            });



        } catch (\Exception $e) {
            \Sentry\captureException($e);
            $actions = [
                'en' => "[fail] email has been successfully sent alerting admins of a request to purchase an advertising package",
                'ar' => "[فشل] إرسال بريد إلكتروني بنجاح لتنبيه المسؤولين عن طلب شراء باقة إعلانية"
            ];
            tenancy()->central(function () use ($actions, $e) {
                Log::create([
                    'action' => $actions,
                    'user_id' => null,
                    'type' => LogTypes::RORequestForAdsFail,
                    'metadata' => [
                        'e_message' => $e->getMessage(),
                        'restaurant_name' => $this->restaurant_name
                    ]
                ]);
            });
        }
    }
}
