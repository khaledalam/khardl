<?php

namespace App\Http\Requests\Web\Tenant\Order;

use App\Enums\Order\TableInvoiceEnum;
use App\Http\Requests\PhoneValidation;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ChangeTableStatusFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'status' => ['required',Rule::in(TableInvoiceEnum::values())],
        ];
    }
}
