<?php

namespace App\Packages\TapPayment\Webhook;


use Closure;
use Exception;
use App\Models\ROSubscription;
use Illuminate\Support\Facades\DB;
use App\Models\ROSubscriptionInvoice;
use App\Models\Tenant\RestaurantUser;
use Spatie\WebhookClient\Models\WebhookCall;
use App\Models\Subscription as CentralSubscription;

class RestaurantCharge
{
    
    public static function updateOrCreate($data){
        if($data['metadata']['subscription'] == ROSubscription::NEW){ 
            self::CreateNewSubscription($data);
        }
        // buy new branches
        else if ($data['metadata']['subscription'] == ROSubscription::RENEW_FROM_CURRENT_END_DATE || $data['metadata']['subscription'] == ROSubscription::RENEW_TO_CURRENT_END_DATE ){
            self::BuyNewBranches($data);
        }
        // activate sub to 1 year 
        else if ($data['metadata']['subscription'] == ROSubscription::RENEW_AFTER_ONE_YEAR){
            self::RenewSubscription($data);
        }else {
            logger('error occur while process payment in subscription, type not defined');
        }
    }
    public static function createNewSubscription($data)
    {
        return self::processSubscription($data, function ($user, $data, $subscription) {
            ROSubscription::create(self::getSubscriptionAttributes($user, $data));
        });
    }
    public static function renewSubscription($data)
    {
        return self::processSubscription($data, function ($user, $data, $subscription) {
            $subscription->update(self::getSubscriptionAttributes($user, $data,$subscription));
        });
    }
    public static function buyNewBranches($data)
    {
        return self::processSubscription($data, function ($user, $data, $subscription) {
            $end_at = $subscription->end_at;
            $amount = $subscription->amount;

            if ($data['metadata']['subscription'] == ROSubscription::RENEW_FROM_CURRENT_END_DATE) {
                $end_at = $subscription->end_at->addDays(365);
                $amount = $data['amount'];
                $data['metadata']['n-branches'] += $subscription->number_of_branches;
            } elseif ($data['metadata']['subscription'] == ROSubscription::RENEW_TO_CURRENT_END_DATE) {
                $amount += $data['amount'];
                $data['metadata']['n-branches'] += $subscription->number_of_branches;
            }

            $subscription->update(self::getSubscriptionAttributes($user, $data,$subscription, $end_at, $amount));
        });
    }

  

    private static function getSubscriptionAttributes($user, $data, $subscription = null,$endAt = null, $amount = null)
    {
        return [
            'start_at' => now(),
            'end_at' => $endAt ?? now()->addDays(365),
            'amount' => $amount ?? $data['amount'],
            'number_of_branches' => ($data['metadata']['n-branches'] == 0)?$subscription->number_of_branches :$data['metadata']['n-branches'],
            'user_id' => $user->id,
            'type' => $data['metadata']['subscription'],
            'status' => ROSubscription::ACTIVE,
            'reminder_email_sent'=>false,
            'reminder_suspend_email_sent'=>false,
            'subscription_id' => $data['metadata']['subscription_id'],
        ];
    }

    private static function processSubscription($data, Closure $callback)
    {
        DB::beginTransaction();
        try {
            $user = RestaurantUser::where('tap_customer_id', $data['customer']['id'])->first();
            $subscription = ROSubscription::first();
            
            if ($data['status'] == 'CAPTURED') { // if payment successful
                $callback($user, $data, $subscription);
            }

            ROSubscriptionInvoice::create([
                'amount' => $data['amount'],
                'number_of_branches' =>  $data['metadata']['n-branches'],
                'user_id' => $user->id,
                'status' => ($data['status'] == 'CAPTURED') ? ROSubscription::ACTIVE : $data['status'],
                'subscription_id' => $data['metadata']['subscription_id'],
                'chg_id' => $data['id'],
                'cus_id' => $user->tap_customer_id,
                'card_id' => $data['card']['id'] ?? null,
                'type' => $data['metadata']['subscription'],
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
