<?php

namespace App\Http\Requests\Web\Tenant\Customer;

use App\Http\Requests\PhoneValidation;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ChangeUserStatusFormRequest extends FormRequest
{
    use PhoneValidation;
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'status' => ['required',Rule::in(RestaurantUser::STATUS)],
        ];
    }
}
