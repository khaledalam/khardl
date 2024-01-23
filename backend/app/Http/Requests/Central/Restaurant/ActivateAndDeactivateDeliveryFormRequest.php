<?php

namespace App\Http\Requests\Central\Restaurant;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class ActivateAndDeactivateDeliveryFormRequest extends FormRequest
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
            'api_key' => ['required'],
            "module" => ['required','in:Yeswa,StreetLine,Cervo'],
        ];
    }
}
