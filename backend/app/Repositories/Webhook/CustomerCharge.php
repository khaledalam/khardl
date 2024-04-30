<?php

namespace App\Repositories\Webhook;

use Closure;
use Exception;
use Throwable;
use App\Models\Tenant\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant\PaymentMethod;
use App\Repositories\Customer\OrderRepository;


class CustomerCharge
{
    
    
    public static function createOrder(array $data)
    {
        DB::beginTransaction();
        try {
            
            if($data['status'] == 'CAPTURED'){
                $order_details = json_decode($data['metadata']['order_data']);
                $order = Order::create((array)$order_details);
                if(!$order){
                    throw new Exception('No order found in system with id #'.$order_details['id']);
                }
            
                $order->update([
                    "payment_status"=> PaymentMethod::PAID,
                    'transaction_id'=>$data['id'],
                ]);
                if(isset($data['source']['payment_method'])){
                    $order->update([
                        'tap_payment_method'=>$data['source']['payment_method']
                    ]);
                }
                DB::commit();
                return $order;
            }
            
           
        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollBack();
            throw new Exception('Error in customer charge webhook '.json_encode($e->getMessage()));

        }catch (Throwable $t){
            logger($t->getMessage());
            DB::rollBack();
            throw new Exception('Error in customer charge webhook '.json_encode($t->getMessage()));
        }
        
        
        return  null;
    }
}
