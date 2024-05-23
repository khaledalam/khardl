<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateEmailOrPhoneRequest extends FormRequest
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
        // dd($this->all());
        if (filter_var($this->emailOrPhone, FILTER_VALIDATE_EMAIL)) {
            return  [
                'emailOrPhone' => 'required|email|exists:users,email|min:10|max:255',
            ];
        } else {
            return  [
                'emailOrPhone' => 'required|exists:users,phone|regex:/^(966)?\d{9}$/',
            ];
        }
       
    }
    protected function prepareForValidation(): void
    {
        $this->validatePhone();
    }
}
