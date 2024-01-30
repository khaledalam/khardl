<?php

namespace App\Repositories\Webhook;

use Closure;
use Exception;
use App\Models\Tenant\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant\PaymentMethod;


class CustomerCharge
{
    
    
    public static function createOrder(array $data)
    {
        DB::beginTransaction();
        try {
            logger('customer charge');
            $order = Order::find($data['metadata']['order_id']);
            if(!$order){
                throw new Exception('No order found in system with id #'.$data['metadata']['order_id']);
            }
            if($data['status'] == 'CAPTURED'){
                $order->update([
                    "payment_status"=> PaymentMethod::PAID
                ]);
            }else if ($data['status'] != 'CAPTURED'){
                $order->update([
                    "payment_status"=> PaymentMethod::FAILED
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
