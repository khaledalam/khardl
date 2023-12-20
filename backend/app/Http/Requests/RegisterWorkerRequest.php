<?php

namespace App\Http\Requests;

use App\Rules\UniqueSubdomain;
use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;

class RegisterWorkerRequest extends FormRequest
{
    use PhoneValidation;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|min:10|max:255|unique:users',
            'password' => 'required|string|min:6|max:255',
            'phone' => 'required|regex:/^(966)?\d{9}$/|unique:users',
        ];
    }
    protected function prepareForValidation()
    {
        $this->validatePhone();
    }
}
