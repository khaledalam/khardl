<?php

namespace App\Http\Services\tenant\OurServices;

use App\Models\Tenant\Branch;
use App\Models\ROSubscription;
use App\Models\Tenant\Setting;
use App\Enums\Admin\CouponTypes;
use App\Models\ROCustomerAppSub;
use App\Traits\APIResponseTrait;
use App\Models\NotificationReceipt;
use App\Models\ROSubscriptionCoupon;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use App\Models\Subscription as CentralSubscription;

class OurServicesService
{
    use APIResponseTrait;
    public function services()
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();

        [$subscription,$customer_app_sub]= tenancy()->central(function () {
            return [
                CentralSubscription::first(),
                CentralSubscription::skip(1)->first()
            ];
        });
        $RO_subscription = ROSubscription::first();
        $setting  = Setting::first();
        $ROCustomerAppSub = ROCustomerAppSub::first();
        $active_branches = Branch::where('active',true)->count();
        $total_branches = $active_branches + ( $RO_subscription->number_of_branches ?? 0);
        $amount = $total_branches * $subscription->amount;
        $non_active_branches = Branch::where('active',false)->count();
        if($RO_subscription && $RO_subscription->status  == ROSubscription::SUSPEND && $active_branches == 0 && $RO_subscription->number_of_branches == 0){
            $amount =  $subscription->amount;
            $total_branches = 1;
        }
        return view('restaurant.service', compact('user','customer_app_sub','ROCustomerAppSub','active_branches','RO_subscription','non_active_branches','subscription','setting','amount','total_branches'));
    }

    public function deactivate()
    {
        /** @var RestaurantUser $user */
        if( ROSubscription::first()->status == ROSubscription::ACTIVE)
        ROSubscription::first()->update([
            'status' => ROSubscription::DEACTIVATE
        ]);
        return redirect()->back()->with('success', __('Branches has been deactivated successfully'));
    }
    public function appDeactivate()
    {
        /** @var RestaurantUser $user */
        if( ROCustomerAppSub::first()->status == ROSubscription::ACTIVE)
        ROCustomerAppSub::first()->update([
            'status' => ROSubscription::DEACTIVATE
        ]);
        return redirect()->back()->with('success', __('Branches has been deactivated successfully'));
    }

    public function activate()
    {
        /** @var RestaurantUser $user */
        $subscription = ROSubscription::first();
        if ($subscription->status != ROSubscription::DEACTIVATE) {
            return redirect()->back()->with('error', __('not allowed'));
        }
        ROSubscription::first()->update([
            'status' => ROSubscription::ACTIVE
        ]);
        return redirect()->back()->with('success', __('Branches has been activated successfully'));
    }
    public function appActivate()
    {
        /** @var RestaurantUser $user */
        $subscription = ROCustomerAppSub::first();
        if ($subscription->status != ROSubscription::DEACTIVATE) {
            return redirect()->back()->with('error', __('not allowed'));
        }
        ROCustomerAppSub::first()->update([
            'status' => ROSubscription::ACTIVE
        ]);
        return redirect()->back()->with('success', __('Branches has been activated successfully'));
    }
    public function calculate($type, $number_of_branches,$subscription_id)
    {
        return ROSubscription::serviceCalculate($type, $number_of_branches,$subscription_id,true);
    }
    public function coupon($coupon,$type,$number_of_branches = null){

        if($type == NotificationReceipt::is_application_purchase || $type == NotificationReceipt::is_branch_purchase) {
            return response()->json( tenancy()->central(function()use($coupon,$type,$number_of_branches){
                $coupon = ROSubscriptionCoupon::where('code',$coupon)->where($type,true)->where(function ($query) {
                    $query->whereColumn('max_use', '>', 'n_of_usage')
                          ->orWhereNull('max_use');
                })->first();
                if(!$coupon) return $coupon;

                if($type == NotificationReceipt::is_branch_purchase ){
                    $cost = CentralSubscription::first()->amount;
                }elseif ($type == NotificationReceipt::is_application_purchase ){
                    $cost = CentralSubscription::skip(1)->first()->amount;
                }
                $after_discount = ($coupon->type == CouponTypes::FIXED_COUPON->value)? $cost * ($number_of_branches ?? 1) - $coupon->amount : (($cost * ($number_of_branches ?? 1)) - ((($cost * ($number_of_branches ?? 1)) * $coupon->amount) / 100));
                return [
                    'cost'=> $after_discount
                ];
            }));
        }
        return false;

    }
}
