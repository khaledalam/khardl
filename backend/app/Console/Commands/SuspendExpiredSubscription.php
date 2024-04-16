<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Models\CentralSetting;
use App\Models\ROSubscription;
use Illuminate\Console\Command;
use App\Jobs\SendRenewSubscriptionEmailJob;
use App\Jobs\SendRenewSuspendSubscriptionEmailJob;
use App\Models\ROCustomerAppSub;
use App\Models\Tenant\Setting;

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
            $restaurant->run(function() use($days,$restaurant){
              
                $subscription = ROSubscription::where('status',ROSubscription::ACTIVE);
                $customer_app_subscription = ROCustomerAppSub::where('status',ROSubscription::ACTIVE);
                $activeSubscription = $subscription->first();
                $activeAppSubscription = $customer_app_subscription->first();
                $activeOrNonActiveSub = $subscription->orWhere('status',ROSubscription::DEACTIVATE)->first();
                $activeOrNonActiveAppSub = $customer_app_subscription->orWhere('status',ROSubscription::DEACTIVATE)->first();
                // Send email to RO if the `RESTAURANT` sub has expired
                if($activeSubscription && $activeSubscription->end_at->isPast() && $activeSubscription->reminder_email_sent == false){
                    SendRenewSubscriptionEmailJob::dispatch(
                        user: $activeSubscription->user,
                        restaurant_name: Setting::first()->restaurant_name,
                        url : $restaurant->route('restaurant.service'),
                        period: $days 
                    );
                    $activeSubscription->update([
                        'reminder_email_sent'=>true
                    ]);
            
                }
                // Send email to RO if the `CUSTOMER APP` sub has expired
                if($activeAppSubscription && $activeAppSubscription->end_at->isPast() && $activeAppSubscription->reminder_email_sent == false){
                    SendRenewSubscriptionEmailJob::dispatch(
                        user: $activeAppSubscription->user,
                        restaurant_name: Setting::first()->restaurant_name,
                        url : $restaurant->route('restaurant.service'),
                        period: $days 
                    );
                    $activeAppSubscription->update([
                        'reminder_email_sent'=>true
                    ]);
            
                }
                // switch the sub status to suspend if RO didn't activate the sub after $days days passed

                if($activeOrNonActiveSub  &&  $activeOrNonActiveSub->end_at->addDays($days)->isPast() && $activeOrNonActiveSub->reminder_suspend_email_sent == false ){
                    SendRenewSuspendSubscriptionEmailJob::dispatch(
                        user: $activeOrNonActiveSub->user, 
                        restaurant_name: Setting::first()->restaurant_name,
                        url : $restaurant->route('restaurant.service'),
                    );
                    $activeOrNonActiveSub->update([
                        'status'=>ROSubscription::SUSPEND,
                        'reminder_suspend_email_sent'=>true
                    ]);
                    
                }
                if($activeOrNonActiveAppSub  &&  $activeOrNonActiveAppSub->end_at->addDays($days)->isPast() && $activeAppSubscription->reminder_suspend_email_sent == false ){
                    SendRenewSuspendSubscriptionEmailJob::dispatch(
                        user: $activeOrNonActiveAppSub->user, 
                        restaurant_name: Setting::first()->restaurant_name,
                        url : $restaurant->route('restaurant.service'),
                    );
                    $activeOrNonActiveAppSub->update([
                        'status'=>ROSubscription::SUSPEND,
                        'reminder_suspend_email_sent'=>true
                    ]);
                    
                }
                

 

            });
        }
    }
}


