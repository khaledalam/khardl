<?php

namespace App\Http\Requests\Central\RestaurantOwner;

use App\Rules\UniqueSubdomain;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateROFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'restaurant_name' => ['required','string','min:3','max:255',new UniqueSubdomain()],
            'commercial_registration' => [
                'nullable',
                'mimes:pdf,jpg,jpeg,png',
                'max:25600',
            ], // 25MB
            'tax_registration_certificate' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25600',
            'bank_certificate' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25600',
            'identity_of_owner_or_manager' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25600',
            'national_address' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25600',
            'commercial_registration_number' => 'nullable|string|min:5|max:255',
            'IBAN' => 'nullable|string|min:10|max:255',
            'facility_name' => 'nullable|string|min:5|max:255',
            'national_id_number' => 'nullable|string|min:5|max:255',
            'dob' => 'nullable|date_format:Y-m-d',
            'first_name' => 'nullable|string|min:3|max:255',
            'last_name' => 'nullable|string|min:3|max:255',
            'email' => 'required|string|email|min:10|max:255|unique:users,email',
            'position' => 'nullable|string|min:3|max:255',
            'password' => 'required|string|min:6|max:255',
            'phone' => 'nullable|regex:/^(966)?\d{9}$/|unique:users,phone',
        ];
    }
}
