<?php

namespace App\Http\Requests;

use App\Models\Tenant\Order;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderStatusChangeRequest extends FormRequest
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
        $order = Order::findOrFail($this->order);
        
        return [
            'status' => [
                'required',
                Rule::in(Order::STATUS),
                function ($attribute, $value, $fail)use($order) {
                    $allowedStatuses = Order::ChangeStatus($order->status);
                    if (!in_array($value, $allowedStatuses)) {
                        $fail("Invalid status transition. Allowed transitions: " . implode(', ', $allowedStatuses));
                    }
                },
            ],
        ];
    }
}
