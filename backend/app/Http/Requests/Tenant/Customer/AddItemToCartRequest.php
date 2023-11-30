<?php

namespace App\Http\Requests\Tenant\Customer;


use Illuminate\Foundation\Http\FormRequest;

class AddItemToCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'item_id' => 'required|int|exists:items,id',
            'quantity' => 'required|numeric|min:1',
        ];
    }

  
}
