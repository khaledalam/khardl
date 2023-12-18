<?php

namespace App\Http\Requests;

use App\Rules\UniqueSubdomain;
use Illuminate\Foundation\Http\FormRequest;

class RestaurantOwnerRegisterRequest extends FormRequest
{
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
            'position' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:6|max:255',
            'c_password' => 'required|same:password',
            'phone' => 'required|regex:/^(966)?\d{10}$/|unique:users',
            'terms_and_policies' => 'accepted',
            'restaurant_name' => ['required','string','min:3','max:255',new UniqueSubdomain()],
        ];
    }
    protected function prepareForValidation()
    {

        if ($this->phone) {
            // Remove any non-digit characters
            $cleanedPhone = preg_replace('/\D/', '', $this->phone);
            if (strlen($cleanedPhone) === 10) {
                // If it's 9 digits, merge with '966'
                $this->merge(['phone' => '966' . $cleanedPhone]);
            } elseif (strlen($cleanedPhone) === 12 && substr($cleanedPhone, 0, 3) === '966') {
                // If it's 12 digits and starts with '966', keep it
                $this->merge(['phone' => $cleanedPhone]);
            }
        }
    }
}
