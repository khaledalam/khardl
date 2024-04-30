<?php

namespace App\Repositories\Webhook;

use Closure;
use Exception;
use Throwable;
use App\Models\Tenant\Branch;
use App\Models\ROSubscription;
use App\Models\Tenant\Setting;
use App\Models\ROCustomerAppSub;
use App\Jobs\SendNotifyForNewSub;
use Illuminate\Support\Facades\DB;
use App\Models\NotificationReceipt;
use App\Models\ROSubscriptionCoupon;
use App\Models\ROSubscriptionInvoice;
use App\Models\Tenant\RestaurantUser;
use App\Models\ROCustomerAppSubInvoice;
use Spatie\WebhookClient\Models\WebhookCall;
use App\Models\Subscription as CentralSubscription;

class RestaurantCharge
{

    public static function updateOrCreate($data){
        DB::beginTransaction();
        try {
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
            }
            else if ($data['metadata']['subscription'] == ROSubscription::RENEW_BRANCH){
                self::renewBranch($data);
            }

            DB::commit();
        }  catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollBack();
            throw new Exception('Error in restaurant sub charge webhook '.json_encode($e->getMessage()));

        }catch (Throwable $t){
            logger($t->getMessage());
            DB::rollBack();
            throw new Exception('Error in restaurant sub charge webhook '.json_encode($t->getMessage()));
        }


    }
    public static function updateOrCreateApp($data){
        DB::beginTransaction();
        try {
            $user = RestaurantUser::first();
            $subscription = ROCustomerAppSub::first();

            if ($data['status'] == 'CAPTURED') { // if payment successful
                $db = [
                    'start_at' => now(),
                    'end_at' => now()->addDays(365),
                    'amount' => $data['amount'],
                    'user_id' => $user->id,
                    'type' => $data['metadata']['subscription'],
                    'status' => ROCustomerAppSub::REQUESTED, // until activate it in the admin dashboard
                    'chg_id' => $data['id'],
                    'reminder_email_sent'=>false,
                    'reminder_suspend_email_sent'=>false,
                    'cus_id' => env('TAP_DEFAULT_CUSTOMER_ID', 'cus_LV06G4620241548c2JK1002613'),
                    'card_id' => $data['card']['id'] ?? null,
                    'discount'=>null,
                    'subscription_id' => $data['metadata']['subscription_id'],
                ];
                if($subscription){
                    if($subscription?->ios_url && $subscription?->android_url ){
                        $db['status'] = ROCustomerAppSub::ACTIVE;
                    }else {
                        $db['status'] = ROCustomerAppSub::REQUESTED;
                        $now = now();
                        $db['created_at'] = $now;
                        $db['updated_at'] = $now;
                    }

                    $subscription->update($db);


                }else {
                    if(isset($data['metadata']['coupon_code'])){
                        $db['coupon_code'] = $data['metadata']['coupon_code'];
                        $db['discount'] = $data['amount'];
                        $db['amount'] =$data['metadata']['sub_amount'];
                    }
                    ROCustomerAppSub::create($db);
                }
            }
            $invoice = [
                'amount' => $data['amount'],
                'user_id' => $user->id,
                'status' => ($data['status'] == 'CAPTURED') ? ROSubscription::ACTIVE : $data['status'],
                'subscription_id' => $data['metadata']['subscription_id'],
                'chg_id' => $data['id'],
                'cus_id' => env('TAP_DEFAULT_CUSTOMER_ID', 'cus_LV06G4620241548c2JK1002613'),
                'card_id' => $data['card']['id'] ?? null,
                'type' => $data['metadata']['subscription'],
            ];
            if(isset($data['metadata']['coupon_code']) && $data['metadata']['subscription'] == ROSubscription::NEW){
                $invoice['coupon_code'] = $data['metadata']['coupon_code'];
                $invoice['discount'] = $data['amount'];
                $invoice['amount'] =$data['metadata']['sub_amount'];
            }
            ROCustomerAppSubInvoice::create($invoice);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }


    }
    public static function createNewSubscription($data)
    {
        return self::processSubscription($data, function ($user, $data, $subscription) {
            $db = self::getSubscriptionAttributes($user, $data);
            if(isset($data['metadata']['coupon_code'])){
                $db['coupon_code'] = $data['metadata']['coupon_code'];
                $db['discount'] = $data['amount'];
                $db['amount'] =$data['metadata']['sub_amount'];
            }
            ROSubscription::create($db);

        });
    }
    public static function renewSubscription($data)
    {
        return self::processSubscription($data, function ($user, $data, $subscription) {
            $subscription->update(self::getSubscriptionAttributes($user, $data,$subscription));
        });
    }
    public static function renewBranch($data)
    {
        return self::processSubscription($data, function ($user, $data, $subscription) {
            $centralSubscription = tenancy()->central(function(){
                return CentralSubscription::first();
            });
            $subscription->update([
                'amount'=>$subscription->amount + $centralSubscription->amount
            ]);
            Branch::withTrashed()->findOrFail( $data['metadata']['branch_id'])->restore();
        });
    }
    public static function buyNewBranches($data)
    {
        return self::processSubscription($data, function ($user, $data, $subscription) {
            $end_at = $subscription->end_at;
            $amount = $subscription->amount;

            // if ($data['metadata']['subscription'] == ROSubscription::RENEW_FROM_CURRENT_END_DATE) {
            //     $end_at = $subscription->end_at->addDays(365);
            //     $amount = $data['amount'];
            //     $data['metadata']['n-branches'] += $subscription->number_of_branches;
            // }
            if($data['metadata']['subscription'] == ROSubscription::RENEW_TO_CURRENT_END_DATE) {
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
            'discount'=>null,
            'subscription_id' => $data['metadata']['subscription_id'],
        ];
    }

    private static function processSubscription($data, Closure $callback)
    {

        $user = RestaurantUser::first();
        $subscription = ROSubscription::first();

        if ($data['status'] == 'CAPTURED') { // if payment successful
            $callback($user, $data, $subscription);
            if( $data['metadata']['subscription'] == ROSubscription::RENEW_AFTER_ONE_YEAR)   // soft delete branches
                Branch::where('active',false)->delete();
        }
        $invoice = [
            'amount' => $data['amount'],
            'number_of_branches' =>  $data['metadata']['n-branches'],
            'user_id' => $user->id,
            'status' => ($data['status'] == 'CAPTURED') ? ROSubscription::ACTIVE : $data['status'],
            'subscription_id' => $data['metadata']['subscription_id'],
            'chg_id' => $data['id'],
            'cus_id' => env('TAP_DEFAULT_CUSTOMER_ID', 'cus_LV06G4620241548c2JK1002613'),
            'card_id' => $data['card']['id'] ?? null,
            'type' => $data['metadata']['subscription'],
        ];
        if(isset($data['metadata']['coupon_code']) && $data['metadata']['subscription'] == ROSubscription::NEW){
            $invoice['coupon_code'] = $data['metadata']['coupon_code'];
            $invoice['discount'] = $data['amount'];
            $invoice['amount'] =$data['metadata']['sub_amount'];
        }
        ROSubscriptionInvoice::create($invoice);


    }
    public static function NotifyUsers($data){
        SendNotifyForNewSub::dispatch(
            Setting::first()->restaurant_name,
            tenant()->id,
            $data['amount'],
            isset($data['metadata']['customer_app'])?NotificationReceipt::is_application_purchase: NotificationReceipt::is_branch_purchase,
            now()->format('Y-m-d H:i'),
        );
    }
    public static function updateCoupon($data){
        return tenancy()->central(function()use($data){
            $coupon = ROSubscriptionCoupon::where('code',$data['metadata']['coupon_code'])->first();
            if($coupon){
                $coupon->update([
                    'n_of_usage' => DB::raw('n_of_usage + 1'),
                ]);
            }
        });
    }
}
