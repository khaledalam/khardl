<?php

namespace App\Http\Requests\Web\Tenant\Order;

use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;


class StoreOrderFormRequest extends FormRequest
{
    use PhoneValidation;
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        /*
        "phone" => "65"
        "first_name" => "Nita"
        "last_name" => "May"
        "delivery_type_id" => "3"
        "shipping_address" => "Sit laborum Quibusd"
        "order_notes" => "Sit aut minus quod e"
        "products" => array:2 [▼
            1 => array:1 [▼
            0 => "1"
            ]
            2 => array:1 [▼
            0 => "1"
            ]
        ]
        */
        return [
            /* 'phone' => 'required|regex:/^(966)?\d{9}$/', */
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'delivery_type_id'  => 'required|integer|exists:delivery_types,id',
            'shipping_address'  => 'required|max:255',
            'order_notes'   => 'nullable|max:255',
            'products'  => 'required|array',
            'products.*'  => ['required','min:1'],
        ];
    }
}
