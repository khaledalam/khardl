<?php

namespace App\Jobs;

use App\Enums\Admin\LogTypes;
use App\Mail\NotifyUsersForNewSub;
use App\Mail\RenewSubscription;
use App\Models\Log;
use App\Models\NotificationReceipt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotifyForNewSub implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    /**
     * Create a new job instance.
     */
    public function __construct(
       public $restaurant_name,
       public $restaurant_id,
       public $cost,
       public $type,
       public $date,

    )
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            if($this->type == NotificationReceipt::is_application_purchase){
                $type_en = "Customer application subscription";
                $type_ar = " تطبيق العميل";
                $log_success =  LogTypes::UserAppSubscriptionNotifySent;
                $log_failed =  LogTypes::UserAppSubscriptionNotifyFail;
            }
            else if ($this->type == NotificationReceipt::is_branch_purchase){
                $type_en = "Restaurant subscription";
                $type_ar = "اشتراك المطعم";
                $log_success = LogTypes::UserSubscriptionNotifySent;
                $log_failed =  LogTypes::UserSubscriptionNotifyFail;

            }else {
                \Sentry\captureMessage("undefined type of subscription for notify users $this->type");
                return ;
            }
            tenancy()->central(function()use($type_ar,$type_en,$log_success){
                $users = NotificationReceipt::where('active',true)->where($this->type,true)->get();
                foreach($users as $user){
                    Mail::to($user->email)->send(new NotifyUsersForNewSub(
                        $user->name ,
                        $this->restaurant_name,
                        $this->restaurant_id,
                        $this->cost,
                        $this->type,
                        $this->date,
                    ));
                    $actions = [
                        'en' => "[ok] An email was sent to alert the users for new or renew $type_en ",
                        'ar' => "[تم] تم إرسال بريد إلكتروني لتنبيه المستخدمين بشراء او تجديد $type_ar "
                    ];

                    Log::create([
                        'user_id' => null,
                        'action' => $actions,
                        'type' => $log_success,
                        'metadata' => [
                            'email' => $user->email ?? null,
                        ]
                    ]);
                }

            });



        } catch (\Exception $e) {
            \Sentry\captureException($e);
            $actions = [
                'en' => "[ok] An email was sent to alert the users for new or renew $type_en ",
                'ar' => "[تم] تم إرسال بريد إلكتروني لتنبيه المستخدمين بشراء او تجديد $type_ar "
            ];
            tenancy()->central(function()use($actions,$log_failed){
                Log::create([
                    'action' => $actions,
                    'user_id' => null,
                    'type' => $log_failed,
                    'metadata' => null
                ]);
            });
        }
    }
}
