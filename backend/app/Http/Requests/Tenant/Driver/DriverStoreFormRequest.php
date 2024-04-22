<?php

namespace App\Http\Requests\Tenant\Driver;

use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;

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
            'phone' => 'required|regex:/^(966)?\d{9}$/|unique:users,phone',
            'address' => 'nullable|max:255',
            'branch_id' => 'required|exists:branches,id',
            'image' => ['nullable','mimes:png,jpg,jpeg,gif','max:4096']
        ];
    }
    protected function prepareForValidation()
    {
        $this->validatePhone();
    }
}
