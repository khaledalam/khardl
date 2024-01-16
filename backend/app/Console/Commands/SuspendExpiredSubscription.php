<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Models\CentralSetting;
use App\Models\ROSubscription;
use Illuminate\Console\Command;
use App\Jobs\SendRenewSubscriptionEmailJob;
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
                $subscriptionForSuspend = clone $subscription;
                $activeSubscription = $subscription->first();
               

                // Send email to RO if the sub has expired
                if($activeSubscription && $subscription->where('end_at',today())->exists()){
                  
                    SendRenewSubscriptionEmailJob::dispatch(
                        user: $activeSubscription->user,
                        restaurant_name: Setting::first()->restaurant_name,
                        url : $restaurant->route('restaurant.service'),
                        period: $days 
                    );
            
                }
                
                // switch the sub status to suspend if RO didn't activate the sub after $days days passed
                if($activeSubscription &&  $subscriptionForSuspend->whereDate('end_at', now()->addDays($days))->exists()) {
                    $activeSubscription->update([
                        'status'=>ROSubscription::SUSPEND
                    ]);
                }
 

            });
        }
    }
}


