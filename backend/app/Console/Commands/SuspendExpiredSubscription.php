<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Tenant;
use App\Models\CentralSetting;
use App\Models\ROSubscription;
use App\Models\Tenant\Setting;
use Illuminate\Console\Command;
use App\Models\ROCustomerAppSub;
use App\Jobs\SendRenewSubscriptionEmailJob;
use App\Jobs\SendRenewSuspendSubscriptionEmailJob;
use Exception;

class SuspendExpiredSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:suspend-expired-subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'suspend all restaurants subscriptions that expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {   

        $days= CentralSetting::first()->active_days_after_sub_expired;
        $restaurants = Tenant::all();
        foreach($restaurants as $restaurant){
            try {
                $restaurant->run(function() use($days,$restaurant){

                    $subscription = ROSubscription::where('status',ROSubscription::ACTIVE);
                    $customer_app_subscription = ROCustomerAppSub::where('status',ROSubscription::ACTIVE);
                    $activeSubscription = $subscription->first();
                    $activeAppSubscription = $customer_app_subscription->first();
                    $activeOrNonActiveSub = $subscription->orWhere('status',ROSubscription::DEACTIVATE)->first();
                    $activeOrNonActiveAppSub = $customer_app_subscription->orWhere('status',ROSubscription::DEACTIVATE)->first();
                    // prevent if the email sent to RO with suspend sub no need to send notice period (in case of notice period email not sent before within n($days)
                    $sub_already_sent = false;
                    $app_sub_already_sent = false;
                    // switch the sub status to suspend if RO didn't activate the sub after $days days passed

                    if($activeOrNonActiveSub  &&  $activeOrNonActiveSub->end_at->addDays($days)->isPast()){
                        $sub_already_sent = true;
                        if($activeOrNonActiveSub->status == ROSubscription::ACTIVE  && $activeOrNonActiveSub->reminder_suspend_email_sent == false )
                            SendRenewSuspendSubscriptionEmailJob::dispatch(
                                user: $activeOrNonActiveSub->user, 
                                restaurant_name: Setting::first()->restaurant_name,
                                url : $restaurant->route('restaurant.service'),
                                type: 'website'
                            );
                        $activeOrNonActiveSub->update([
                            'status'=>ROSubscription::SUSPEND,
                            'reminder_suspend_email_sent'=>($activeOrNonActiveSub->status == ROSubscription::ACTIVE)?true:false
                        ]);
                        
                    }
                    if($activeOrNonActiveAppSub  &&  $activeOrNonActiveAppSub->end_at->addDays($days)->isPast() ){
                        $app_sub_already_sent = true;
                        if($activeOrNonActiveAppSub->status == ROSubscription::ACTIVE && $activeAppSubscription->reminder_suspend_email_sent == false )
                        SendRenewSuspendSubscriptionEmailJob::dispatch(
                            user: $activeOrNonActiveAppSub->user, 
                            restaurant_name: Setting::first()->restaurant_name,
                            url : $restaurant->route('restaurant.service'),
                            type: 'app'
                        );
                        $activeOrNonActiveAppSub->update([
                            'status'=>ROSubscription::SUSPEND,
                            'reminder_suspend_email_sent'=>true
                        ]);
                        
                    }
    
                    // Send email to RO if the `RESTAURANT` sub has expired
                    if($activeSubscription && $activeSubscription->end_at->isPast()){
                        $futureDate = $activeSubscription->end_at->copy()->addDays($days+1);
                        $todayDate = Carbon::now();
                        $numberOfDaysDiff = $todayDate->diffInDays($futureDate);
                        if(!$sub_already_sent  && $activeSubscription->reminder_email_sent == false)
                        SendRenewSubscriptionEmailJob::dispatch(
                            user: $activeSubscription->user,
                            restaurant_name: Setting::first()->restaurant_name,
                            url : $restaurant->route('restaurant.service'),
                            period: $numberOfDaysDiff ,
                            type: 'website'
                        );
                        $activeSubscription->update([
                            'reminder_email_sent'=>!$sub_already_sent
                        ]);
                
                    }
                    // Send email to RO if the `CUSTOMER APP` sub has expired
                    if($activeAppSubscription && $activeAppSubscription->end_at->isPast() ){
                      
                        $futureDate = $activeOrNonActiveAppSub->end_at->copy()->addDays($days+1);
                        $todayDate = Carbon::now();
                        $numberOfDaysDiff = $todayDate->diffInDays($futureDate);
                        if(!$app_sub_already_sent && $activeAppSubscription->reminder_email_sent == false)
                        SendRenewSubscriptionEmailJob::dispatch(
                            user: $activeAppSubscription->user,
                            restaurant_name: Setting::first()->restaurant_name,
                            url : $restaurant->route('restaurant.service'),
                            period: $numberOfDaysDiff ,
                            type: 'app'
                        );
                        $activeAppSubscription->update([
                            'reminder_email_sent'=>!$app_sub_already_sent
                        ]);
                
                    }
                    
                    
    
     
    
                });
            }catch(Exception $e){
                \Sentry\captureException($e);
            }
           
        }
    }
}


