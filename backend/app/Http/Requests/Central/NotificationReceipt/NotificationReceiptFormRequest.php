<?php

namespace App\Http\Requests\Central\NotificationReceipt;

use App\Utils\ResponseHelper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class NotificationReceiptFormRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:notification_receipts,email',
            'is_application_purchase' => 'nullable|boolean',
            'is_branch_purchase' => 'nullable|boolean',

        ];
    }
}
