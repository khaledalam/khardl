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
            'delivery_types.*' => ['required', 'min:1', 'in:Delivery,PICKUP'],
            'payment_methods.*' => ['required', 'min:1', 'in:Online,Cash on Delivery'],
            'preparation_time_delivery'=>'nullable|date_format:"H:i:s"'
        ];
    }



}
