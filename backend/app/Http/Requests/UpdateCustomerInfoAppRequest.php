<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerInfoAppRequest extends FormRequest
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
        $user = Auth::user();
        return [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => "nullable|regex:/^(966)?\d{9}$/|unique:users,phone,$user->id",
            'email' => 'nullable|string|email|min:10|max:255|unique:users',
        ];
    }
    protected function prepareForValidation()
    {
        $this->validatePhone();
    }
}
