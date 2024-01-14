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
    

    public static function createNewSubscription($data)
    {
        return self::processSubscription($data, function ($user, $data, $subscription) {
            ROSubscription::create(self::getSubscriptionAttributes($user, $data));
        });
    }
    public static function renewSubscription($data)
    {
        return self::processSubscription($data, function ($user, $data, $subscription) {
            $subscription->update(self::getSubscriptionAttributes($user, $data));
        });
    }
    public static function buyNewBranches($data)
    {
        return self::processSubscription($data, function ($user, $data, $subscription) {
            $end_at = $subscription->end_at;
            $amount = $subscription->amount;

            if ($data['metadata']['subscription'] == ROSubscription::RENEW_FROM_CURRENT_END_DATE) {
                $end_at = $subscription->end_at->addYear();
                $amount = $data['amount'];
            } elseif ($data['metadata']['subscription'] == ROSubscription::RENEW_TO_CURRENT_END_DATE) {
                $amount += $data['amount'];
            }

            $subscription->update(self::getSubscriptionAttributes($user, $data, $end_at, $amount));
        });
    }

  

    private static function getSubscriptionAttributes($user, $data, $endAt = null, $amount = null)
    {
        return [
            'start_at' => now(),
            'end_at' => $endAt ?? now()->addYear(),
            'amount' => $amount ?? $data['amount'],
            'number_of_branches' => $data['metadata']['n-branches'],
            'user_id' => $user->id,
            'type' => $data['metadata']['subscription'],
            'status' => ROSubscription::ACTIVE,
            'subscription_id' => $data['reference']['order'],
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
                'subscription_id' => $data['reference']['order'],
                'chg_id' => $data['id'],
                'cus_id' => $user->tap_customer_id,
                'card_id' => $data['card']['id'] ?? null,
                'payment_agreement_id' => $data['payment_agreement']['id'] ?? null,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
