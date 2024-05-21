<?php

namespace App\Http\Requests\Central\RestaurantOwner;
use App\Http\Requests\PhoneValidation;
use Illuminate\Support\Str;
use App\Rules\UniqueSubdomain;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantOwnerFromRequest extends FormRequest
{
    use PhoneValidation;

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
        $user = $this->user;
        return [
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|min:10|max:255|unique:users,email,'.$this->user?->id,
            'position' => 'required|string|min:3|max:255',
            'password' => 'nullable|string|min:6|max:255',
            'phone' => 'required|regex:/^(966)?\d{9}$/|unique:users,phone,'.$this->user?->id,
            'restaurant_name' => ['required','string','min:3','max:255',new UniqueSubdomain($except = $this->user->id)],
            'restaurant_name_ar' => [
                'required',
                'string',
                'regex:/^[0-9\p{Arabic}\s]+$/u',
            ],
        ];
    }

    public function messages()
    {
        return [
            'restaurant_name_ar.required' => __('Restaurant arabic name is required'),
            'restaurant_name_ar.regex' => __('Restaurant arabic name is invalid'),
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
