<?php

namespace App\Repositories\Customer;

use Exception;
use App\Models\Tenant\Order;
use App\Traits\APIResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Tenant\Customer\OrderRequest;
use App\Models\Tenant\DeliveryType;
use App\Models\Tenant\OrderItem;

class OrderRepository
{
    use APIResponseTrait;
    public function create(OrderRequest $request,CartRepository $cart): JsonResponse
    {
        DB::beginTransaction();
        try {
            if($cart->hasPaymentCashOnDelivery($request->payment_method)){
                $subtotal = $cart->subTotal();
                $delivery = DeliveryType::where('name',$request->delivery_type)->first();

                $order = Order::create([
                    'user_id'=>Auth::id(),
                    'branch_id'=>$cart->branch()->id,
                    'payment_method_id'=> PaymentMethod::where('name',$request->payment_method)->first()->id,
                    'delivery_type_id'=> $delivery->id,
                    'total'=>$cart->total($subtotal)  + $delivery->cost,
                    'delivery_cost'=> $delivery->cost,
                    'subtotal' =>$subtotal,
                    'shipping_address'=>$request->shipping_address,
                    'order_notes'=>$request->order_notes,
                    // TODO @todo update
                    'payment_status'=>'pending',
                    'status'=>'pending',


                ]);
                $cart->clone_to_order_items($order->id);
                $cart->trash();
                DB::commit();
                return $this->sendResponse(null, __('The order been created successfully.'));

            }else if ($cart->hasPaymentCreditCard($request->payment_method)){
                // TODO @todo not yet
            }
        }catch(Exception $e){
            DB::rollBack();
            logger($e->getMessage());
        }
        return $this->sendError('Fail', __('The order failed to complete'));

    }
    public static function clone_cart_items(
        $order_id,
        $item_id,
        $quantity,
        $price,
        $options_price,
        $total,
        $notes
    ){
        OrderItem::create([
            'order_id'=>$order_id,
            'item_id'=>$item_id,
            'quantity'=>$quantity,
            'price'=>$price,
            'options_price'=>$options_price,
            'total'=>$total,
            'notes' => $notes
        ]);
    }
}
