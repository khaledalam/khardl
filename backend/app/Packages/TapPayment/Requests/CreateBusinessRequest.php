<?php

namespace App\Packages\TapPayment\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBusinessRequest  extends FormRequest
{
   /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name.en' => 'required|string',
            'name.ar' => 'nullable|string',
            'type' => 'required|string',
            'entity' => [
                'legal_name.en' => 'required|string',
                'legal_name.ar' => 'nullable|string',
                'is_licensed' => 'required|boolean',
                'license' => [
                    'type' => 'nullable|string',
                    'number' => 'nullable|string',
                ],
                'not_for_profit' => 'nullable|boolean',
                'country' => 'nullable|string',
                'tax_number' => 'nullable|string',
                'bank_account' => [
                    'iban' => 'nullable|string',
                    'swift_code' => 'nullable|string',
                    'account_number' => 'nullable|string',
                ],
                'billing_address' => [
                    'recipient_name' => 'nullable|string',
                    'address_1' => 'nullable|string',
                    'address_2' => 'nullable|string',
                    'po_box' => 'nullable|string',
                    'district' => 'nullable|string',
                    'city' => 'nullable|string',
                    'state' => 'nullable|string',
                    'zip_code' => 'nullable|string',
                    'country' => 'nullable|string',
                ],
                'documents' => 'nullable|array',
                'documents.*' => 'nullable|array',
                'documents.*.type' => 'nullable|string',
                'documents.*.number' => 'nullable|string',
                'documents.*.issuing_country' => 'nullable|string',
                'documents.*.issuing_date' => 'nullable|date_format:Y-m-d',
                'documents.*.expiry_date' => 'nullable|date_format:Y-m-d',
                'documents.*.files' => 'nullable|array',
                // ... continue with other rules
            ],
            'contact_person' => [
                'name.title' => 'nullable|string',
                'name.first' => 'nullable|string',
                'name.middle' => 'nullable|string',
                'name.last' => 'nullable|string',
                'contact_info' => [
                    'primary.email' => 'nullable|string',
                    'primary.phone' => 'nullable|string',
                ],
                'nationality' => 'nullable|string',
                'date_of_birth' => 'nullable|date_format:Y-m-d',
                'is_authorized' => 'nullable|boolean',
                'authorization' => [
                    'name.title' => 'nullable|string',
                    'name.first' => 'nullable|string',
                    'name.middle' => 'nullable|string',
                    'name.last' => 'nullable|string',
                    'type' => 'nullable|string',
                    'issuing_country' => 'nullable|string',
                    'issuing_date' => 'nullable|date_format:Y-m-d',
                    'expiry_date' => 'nullable|date_format:Y-m-d',
                    'files' => 'nullable|array'
                ],
                'identification' => 'nullable|array',
                'identification.*' => 'nullable|array',
                'identification.*.name.title' => 'nullable|string',
                'identification.*.name.first' => 'nullable|string',
                'identification.*.name.middle' => 'nullable|string',
                'identification.*.name.last' => 'nullable|string',
                'identification.*.type' => 'nullable|string',
                'identification.*.number' => 'nullable|string',
                'identification.*.issuing_country' => 'nullable|string',
                'identification.*.issuing_date' => 'nullable|date_format:Y-m-d',
                'identification.*.expiry_date' => 'nullable|date_format:Y-m-d',
                'identification.*.files' => 'nullable|array'
            ],
            'brands' => 'required|array',
            'brands.*' => 'required|array',
            'brands.*.name.en' => 'required|string',
            'brands.*.name.ar' => 'nullable|string',
            'brands.*.sector' => 'nullable|array',
            'brands.*.website' => 'nullable|string|url',
            'brands.*.social' => 'nullable|array',
            'brands.*.social.*' => 'nullable|string|url',
            'brands.*.logo' => 'nullable|string',
            'brands.*.content' => 'nullable|array',
            'brands.*.content.tag_line.en' => 'nullable|string',
            'brands.*.content.tag_line.ar' => 'nullable|string',
            'brands.*.content.about.en' => 'nullable|string',
            'brands.*.content.about.ar' => 'nullable|string',
            'post' => [
                'url' => 'nullable|string|url',
            ],
            'metadata' => [
                'mtd' => 'nullable|string',
            ],
        ];
    }
    
}