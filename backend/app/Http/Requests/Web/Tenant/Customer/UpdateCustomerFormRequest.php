<?php

namespace App\Http\Requests\Web\Tenant\Customer;

use App\Http\Requests\PhoneValidation;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateCustomerFormRequest extends FormRequest
{
    use PhoneValidation;
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|min:10|max:255|unique:users,email,'.$this->restaurantUser->id,
            'phone' => 'required|regex:/^(966)?\d{9}$/|unique:users,phone,'.$this->restaurantUser->id,
            'status' => ['required',Rule::in(RestaurantUser::STATUS)],
        ];
    }
    protected function prepareForValidation()
    {
        $this->validatePhone();
    }
}
