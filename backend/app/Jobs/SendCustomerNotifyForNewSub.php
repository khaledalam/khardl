<?php

namespace App\Jobs;

use App\Enums\Admin\LogTypes;
use App\Mail\NotifyCustomerForNewSub;
use App\Models\Log;
use App\Models\NotificationReceipt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCustomerNotifyForNewSub implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    /**
     * Create a new job instance.
     */
    public function __construct(
        public $customer,
        public $restaurant_name,
        public $restaurant_id,
        public $cost,
        public $type,
        public $date,

    ) {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            if ($this->type == NotificationReceipt::is_application_purchase) {
                $log_success = LogTypes::CustomerAppNotifySent;
                $log_failed = LogTypes::CustomerAppNotifyFail;
                $actions = [
                    'en' => "[ok] mail has been sent to customer for purchase app",
                    'ar' => "[تم] تم ارسال بريد الي العميل لشراء تطبيق"
                ];
            } else if ($this->type == NotificationReceipt::is_branch_purchase) {
                $log_success = LogTypes::CustomerBranchNotifySent;
                $log_failed = LogTypes::CustomerBranchNotifyFail;
                $actions = [
                    'en' => "[ok] mail has been sent to customer for purchase/renew branch",
                    'ar' => "[تم] تم إرسال بريد إلى العميل لشراء او تجديد فرع"
                ];
            } else {
                \Sentry\captureMessage("undefined type of subscription for notify users $this->type");
                return;
            }
            tenancy()->central(function () use ($log_success,$actions) {
                Mail::to($this->customer?->email)->send(
                    new NotifyCustomerForNewSub(
                        $this->customer?->full_name,
                        $this->restaurant_name,
                        $this->restaurant_id,
                        $this->cost,
                        $this->type,
                        $this->date,
                    )
                );

                Log::create([
                    'user_id' => null,
                    'action' => $actions,
                    'type' => $log_success,
                    'metadata' => [
                        'email' => $this->customer?->email ?? null,
                    ]
                ]);

            });



        } catch (\Exception $e) {
            \Sentry\captureException($e);
            tenancy()->central(function () use ($actions, $log_failed,$e) {
                Log::create([
                    'action' => $actions,
                    'user_id' => null,
                    'type' => $log_failed,
                    'metadata' => [
                        'email' => $this->customer?->email ?? null,
                        'e_message' => $e->getMessage(),
                    ]
                ]);
            });
        }
    }
}
