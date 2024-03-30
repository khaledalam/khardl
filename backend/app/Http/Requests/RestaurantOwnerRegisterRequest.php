<?php

namespace App\Http\Requests;

use App\Models\Tenant\Order;
use Illuminate\Support\Str;
use App\Rules\UniqueSubdomain;
use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;

class RestaurantOwnerRegisterRequest extends FormRequest
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
            'position' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:6|max:255',
            'c_password' => 'required|same:password',
            'phone' => 'required|regex:/^(966)?\d{9}$/|unique:users',
            'terms_and_policies' => 'accepted',
            'restaurant_name' => ['required','string','min:3','max:255',new UniqueSubdomain()],
            'restaurant_name_ar' => [
                'required',
                'string',
                'regex:/^[0-9\p{Arabic}\s]+$/u',
            ],
            'dob' => 'nullable|date_format:Y-m-d'
        ];
    }

    public function messages()
    {
        return [
            'restaurant_name_ar.required' => __('Restaurant arabic name is required'),
            'restaurant_name_ar.regex' => __('Restaurant arabic name is invalid'),
            'dob.required' => __('Date of birth is required'),
            'dob.regex' => __('Date of birth is invalid'),
        ];
    }

    protected function prepareForValidation()
    {
        $this->validatePhone();
    }
    protected function passedValidation(): void
    {
        $this->replace(['restaurant_name' => Str::lower($this->restaurant_name)]);
    }
}
