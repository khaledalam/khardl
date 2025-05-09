<?php

namespace App\Http\Requests\Tenant\Customer;


use App\Models\Tenant\Item;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemCartRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;

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
            'quantity' => 'required|int|min:1', 
            'notes' => 'nullable|string',
            'selectedCheckbox'=> 'nullable',
            'selectedRadio'=> 'nullable',
            'selectedDropdown'=> 'nullable',
        ];
    }

   

}
