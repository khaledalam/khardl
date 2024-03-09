<?php

namespace App\Repositories\Customer;

use App\Enums\Admin\NotificationTypeEnum;
use App\Models\Tenant\OrderStatusLogs;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\Setting;
use App\Notifications\NotificationAction;
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
use Illuminate\Support\Facades\Notification;

class OrderRepository
{
    use APIResponseTrait;
    public function create(OrderRequest $request,CartRepository $cart,$user = null): Order | JsonResponse
    {
        DB::beginTransaction();
        try {
            $user= $user ?? Auth::user();
            $subtotal = $cart->subTotal();
            $delivery = DeliveryType::where('name',$request->delivery_type)->first();
            $paymentMethod = PaymentMethod::where('name',$request->payment_method)?->first();
            $coupon = $cart->coupon();
            $discount = $cart->discount();
            $order = Order::create([
                'user_id' => $user->id,
                'branch_id' => $cart->branch()->id,
                'payment_method_id' => $paymentMethod?->id,
                'delivery_type_id' => $delivery->id,
                'total' => $cart->total($subtotal) + $delivery->cost,
                'delivery_cost' => $delivery->cost,
                'subtotal' => $subtotal,
                'shipping_address' => $request->shipping_address,
                'order_notes' => $request->order_notes,
                'coupon_id' => $coupon && $discount != 0 ? $coupon->id : null,
                'discount' => $discount ? $discount : null,
                // TODO @todo update
                'payment_status' => PaymentMethod::PENDING,
                'vat' => $cart->tax(),
                'status' => Order::PENDING,
                'lat'=>$user->lat ?? null,
                'lng'=>$user->lng ?? null,
                'address'=>$user->address ?? null,
                'manual_order_first_name' => $request->manual_order_first_name,
                'manual_order_last_name' => $request->manual_order_last_name
            ]);
            $this->sendNotifications($user, $order);
            if($discount&&$coupon){
                $user->coupons()->attach($coupon->id);
            }
            $cart->clone_to_order_items($order->id);
            $statusLog = new OrderStatusLogs();
            $statusLog->order_id = $order->id;
            $statusLog->status = Order::PENDING;
            $statusLog->notes = 'Order Notes: ' . $request->order_notes;
            $statusLog->saveOrFail();

            if($cart->hasPaymentCashOnDelivery($request->payment_method)){


                // @TODO: fetch transaction fee percentage that need to be deduce from
                // each TAP transaction from super admin dashboard settings


                // @TODO: Create TAP charge

                $cart->trash();

                DB::commit();
                return $this->sendResponse($order, __('The order been created successfully.'));

            }else if ($cart->hasPaymentCreditCard($request->payment_method)){
                // Do not commit any change , it should be saved into session

                DB::commit();
                return $order;
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
    public function sendNotifications($user, $order)
    {
        //Internal notification
        $type = NotificationTypeEnum::OrderCreated;
        $message = __('New order has been created for customer :name.',['name' => $user->full_name]);
        //Send notification to all worker
        $workers = RestaurantUser::workers()->get();
        if($workers->count())Notification::send($workers, new NotificationAction($type, $message, $order));
    }
}
