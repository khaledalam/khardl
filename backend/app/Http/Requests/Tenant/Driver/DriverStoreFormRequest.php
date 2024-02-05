<?php

namespace App\Http\Requests\Tenant\Driver;

use App\Http\Requests\PhoneValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class DriverStoreFormRequest extends FormRequest
{
    use PhoneValidation;
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
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|min:10|max:255|unique:users',
            'password' => 'required|string|min:6|max:255',
            'phone' => 'required|regex:/^(966)?\d{9}$/|unique:users',
            'address' => 'nullable|max:255',
            'branch_id' => 'required|exists:branches,id'
        ];
    }
    protected function prepareForValidation()
    {
        $this->validatePhone();
    }
}
