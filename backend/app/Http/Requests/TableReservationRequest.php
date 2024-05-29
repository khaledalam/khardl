<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Enums\Order\TableInvoiceEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class TableReservationRequest extends FormRequest
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
            'n_of_guests' => 'required|integer|min:1',
            'date_time' => 'required|date_format:Y-m-d H:i:s',
            'environment' => 'required|in:indoor,outdoor',
            'user_id' => [
                Rule::requiredIf(function () {
                    return is_null($this->input('new_customer'));
                }),
                'required',
                'integer'
            ],
            'note' => 'nullable|string',
            'new_user'=>"nullable|string",
            'status' => ['required',new Enum(TableInvoiceEnum::class)]
        ];
    }
}
