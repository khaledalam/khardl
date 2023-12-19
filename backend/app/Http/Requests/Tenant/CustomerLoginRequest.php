<?php

namespace App\Http\Requests\Tenant;

use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;


class CustomerLoginRequest extends FormRequest
{
    use PhoneValidation;
    public function authorize(){
        return true;
    }
    public function rules()
    {

        return [
            'phone' => 'required|exists:users',
        ];
    }


    protected function prepareForValidation()
    {
        $this->validatePhone();
    }
}
