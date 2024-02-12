<?php

namespace App\Http\Requests;

use App\Models\Tenant\DeliveryType;
use App\Models\Tenant\Order;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderStatusChangeRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
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
        $order = Order::findOrFail($this->order);

        return [
            'status' => [
                'required',
                Rule::in(Order::STATUS),
                function ($attribute, $value, $fail)use($order) {
                    $allowedStatuses = Order::ChangeStatus($order->status);
                    if (!in_array($value, $allowedStatuses)) {
                        if($allowedStatuses == []){
                            $fail(__("Cannot change this status"));
                            return ;
                        }
                        $fail(__("Invalid status transition. Allowed transitions: ") . implode(', ', array_map(fn($status)=>__('messages.'.$status),$allowedStatuses)));
                    }
                    if(
                        $order->delivery_type->name == DeliveryType::DELIVERY &&
                        $order->status == Order::PENDING &&
                        $value != Order::RECEIVED_BY_RESTAURANT  &&
                        $value != Order::CANCELLED &&
                        $value != Order::REJECTED

                    ){
                        $fail(__("The only available cases for changing the order status are receiving by the restaurant or canceling the order"));
                    }
                },
            ],
            'reason' => [
                Rule::requiredIf(function () use ($order) {
                return $this->input('status') === Order::REJECTED;
                })
            ]
        ];
    }
}
