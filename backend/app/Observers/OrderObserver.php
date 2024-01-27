<?php

namespace App\Observers;
use App\Models\Tenant\Order;
use App\Models\Tenant\Setting;



class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if($order->status == Order::COMPLETED){
            $user = $order->user;
            $this->updateCashBackAndLoyalty($user,$order);
        }
    }
    private function updateCashBackAndLoyalty($user,$order)
    {
        $setting = Setting::first();
        if($setting->loyalty_points) $user->loyalty_points += ($order->total * $setting->loyalty_points);
        if($setting->cashback_percentage){
            if($order->total >= $setting->cashback_threshold){
                logger('test');
                $user->cashback += (($order->total * $setting->cashback_percentage) / 100.0);
            }
        }
        $user->save();
    }
    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
