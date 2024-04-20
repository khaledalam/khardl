<?php

namespace App\Http\Requests\API\Driver\Order;

use App\Models\Tenant\Order;
use App\Models\Tenant\Setting;
use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $order = $this->route('order');

    return [
        'status' => ['required', 'in:' . implode(',', [
            Order::ACCEPTED,
            Order::CANCELLED,
            Order::COMPLETED,
        ]), function ($attribute, $value, $fail) use ($order) {
            // Check status based on order and user
            if($order->branch_id != getAuth()->branch_id){
                $fail(__('Order is not for you branch'));
            }
            if ($value == Order::COMPLETED) {
                if($order->status != Order::ACCEPTED){
                    $fail(__('Order is not accepted yet'));
                }
                if($order->driver_id != auth()->id()){
                    $fail(__('Order is not for you'));
                }
            } elseif ($value == Order::CANCELLED) {
                if($order->status != Order::ACCEPTED){
                    $fail(__('Order is not accepted yet'));
                }
                if($order->driver_id != auth()->id()){
                    $fail(__('Order is not for you'));
                }
            } elseif ($value == Order::ACCEPTED) {
                if(($order->driver_id != null && $order->driver_id != auth()->id())||$order->status == Order::ACCEPTED){
                    $fail(__('Order has assigned for someone else'));
                    return;
                }
                if (($order->status != Order::RECEIVED_BY_RESTAURANT && $order->status != Order::READY)){
                    $fail(__('You can not receive this order because its not ready or accepted by restaurant'));
                }
                if($order->deliver_by != null){
                    $fail(__('Order has assigned for someone else'));
                }
                $settings = Setting::first();
                $limitDrivers = $settings->limit_delivery_company;
                if ($limitDrivers && $limitDrivers > 0) {
                    if (!($order->received_by_restaurant_at > now()->subMinutes($limitDrivers))) {
                        return $fail(__('You cannot pick up this order now because you have exceeded the time allowed for order pickup'));
                    }
                }
            }
        }],
        'reason' => ['required_if:status,' . Order::CANCELLED],
    ];
    }
}
