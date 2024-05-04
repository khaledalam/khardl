<?php

namespace App\Jobs;

use App\Enums\Admin\LogTypes;
use App\Mail\ApplicationsIsReadyMail;
use App\Mail\NotifyUsersForNewSub;
use App\Models\Log;
use App\Models\NotificationReceipt;
use App\Models\ROCustomerAppSub;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWhenAppReady implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    /**
     * Create a new job instance.
     */
    public function __construct(
        public $customer,
        public ROCustomerAppSub $rOCustomerAppSub,

    ) {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->customer?->email)->send(new ApplicationsIsReadyMail($this->rOCustomerAppSub));
            $actions = [
                'en' => "[success] Send mail to customer when app is published",
                'ar' => "[تم] ارسال بريد للعميل عند نشر التطبيق"
            ];
            tenancy()->central(function () use($actions) {
                Log::create([
                    'user_id' => $this->customer?->id,
                    'action' => $actions,
                    'type' => LogTypes::AppIsPublishedNotifySent,
                    'metadata' => [
                        'email' => $this->customer?->email,
                        'name' => $this->customer?->full_name,
                    ]
                ]);
            });
        } catch (\Exception $e) {
            \Sentry\captureException($e);
            $actions = [
                'en' => "[fail] failed to send mail to customer when app is published",
                'ar' => "[فشل] فشل إرسال البريد إلى العميل عند نشر التطبيق"
            ];
            tenancy()->central(function () use($actions){
                Log::create([
                    'action' => $actions,
                    'user_id' => $this->customer?->id,
                    'type' => LogTypes::AppIsPublishedNotifyFail,
                    'metadata' => [
                        'email' => $this->customer?->email,
                        'name' => $this->customer?->full_name,
                    ]
                ]);
            });
        }
    }
}
