<?php

namespace App\Http\Requests\Tenant\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateFormRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'delivery_fee' => 'required|numeric|min:0',
            'limit_delivery_company' => 'nullable|integer|min:0',
        ];
    }
}
