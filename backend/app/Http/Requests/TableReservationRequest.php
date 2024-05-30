<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Rules\ValidateTableDatetime;
use Illuminate\Support\Facades\Auth;
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
            'branch_id' => 'required|integer',
            'date_time' => ['required','after_or_equal:today','date_format:Y-m-d H',new ValidateTableDatetime($this->input('branch_id'))],
            'environment' => 'required|in:indoor,outdoor',
            'user_id' => [
                Rule::requiredIf(function () {
                    return is_null($this->input('new_user'));
                }),
                'nullable',
                'integer'
            ],
            'note' => 'nullable|string',
            'new_user'=>"nullable|string",
            'status' => ['required',new Enum(TableInvoiceEnum::class)]
        ];
    }
    protected function prepareForValidation()
    {
        if(Auth::user()->isCustomer())
            $this->merge([
                'user_id' => Auth::id(),
                'new_user'=>null,
                'status'=>TableInvoiceEnum::PENDING->value
            ]);
    }
}
