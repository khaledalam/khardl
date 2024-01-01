<?php

namespace App\Repositories\Customer;

use App\Models\Tenant\OrderStatusLogs;
use App\Models\Tenant\Payment;
use App\Models\Tenant\Setting;
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
use App\Packages\DeliveryCompanies\DeliveryCompanies;

class OrderRepository
{
    use APIResponseTrait;
    public function create(OrderRequest $request,CartRepository $cart,$user = null): JsonResponse
    {
        DB::beginTransaction();
        try {
            $user= $user ?? Auth::user();
            if($cart->hasPaymentCashOnDelivery($request->payment_method)){
                $subtotal = $cart->subTotal();
                $delivery = DeliveryType::where('name',$request->delivery_type)->first();

                $paymentMethod = PaymentMethod::where('name',$request->payment_method)?->first();

                $order = Order::create([
                    'user_id'=>$user->id,
                    'branch_id'=>$cart->branch()->id,
                    'payment_method_id'=> $paymentMethod?->id,
                    'delivery_type_id'=> $delivery->id,
                    'total' => $cart->total($subtotal)  + $delivery->cost,
                    'subtotal' =>$subtotal,
                    'shipping_address'=>$request->shipping_address,
                    'order_notes'=>$request->order_notes,
                    // TODO @todo update
                    'payment_status' => Payment::PENDING,
                    'status'=> Order::PENDING,

                ]);

                $statusLog = new OrderStatusLogs();
                $statusLog->order_id = $order->id;
                $statusLog->status = Order::PENDING;
                $statusLog->notes = 'Order Notes: ' . $request->order_notes;
                $statusLog->saveOrFail();
                
                $cart->clone_to_order_items($order->id);

               
                $cart->trash();

                
                DB::commit();
                return $this->sendResponse($order, __('The order been created successfully.'));

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
        $notes,
        $checkbox_options,
        $selection_options,
        $dropdown_options
    ){
        OrderItem::create([
            'order_id'=>$order_id,
            'item_id'=>$item_id,
            'quantity'=>$quantity,
            'price'=>$price,
            'options_price'=>$options_price,
            'checkbox_options'=>$checkbox_options,
            'selection_options'=>$selection_options,
            'dropdown_options'=>$dropdown_options,
            'total'=>$total,
            'notes' => $notes
        ]);
    }
}
