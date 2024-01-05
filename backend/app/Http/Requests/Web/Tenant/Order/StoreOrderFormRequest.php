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
        return [
            'phone' => 'required|regex:/^(966)?\d{9}$/',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'branch_id' => 'required|integer|exists:branches,id',
            'delivery_type_id'  => 'required|integer|exists:delivery_types,id',
            'shipping_address'  => 'required|max:255',
            'order_notes'   => 'nullable|max:255',
            'products'  => 'required|array',
            'products.*'  => ['required','min:1'],
        ];
    }
    protected function prepareForValidation()
    {
        $this->validatePhone();
    }
}
