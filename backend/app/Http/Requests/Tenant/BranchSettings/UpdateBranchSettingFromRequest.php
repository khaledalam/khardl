<?php

namespace App\Http\Requests\Tenant\BranchSettings;


use App\Models\Tenant\Item;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchSettingFromRequest extends FormRequest
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
            'payment_methods' => ['required','array'],
            'delivery_types' => ['required','array'],
            'delivery_types.*' => ['in:Delivery,PICKUP,PICKUP By Car'],
            'payment_methods.*' => ['in:Credit Card,Cash on Delivery'],
        ];
    }



}
