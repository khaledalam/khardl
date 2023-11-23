<?php

namespace App\Packages\TapPayment\Requests;

use LVR\CountryCode\Two;
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
            'type' => 'required|string|in:ind,corp',
            'entity' => 'required',
            'entity.legal_name.en' => 'required|string',
            'entity.legal_name.ar' => 'nullable|string',
            'entity.is_licensed' => 'required|boolean',
            'entity.license' => 'nullable|array',
            'entity.license.type' => 'nullable|string|in:Commercial Registration,Commercial License',
            'entity.license.number' => 'nullable|string',
            'entity.not_for_profit' => 'nullable|boolean',
            'entity.country' => ['required','string', new Two],
            'entity.tax_number' => 'nullable|string',
            'entity.bank_account' => 'nullable|array',
            'entity.bank_account.iban' => 'nullable|string',
            'entity.bank_account.swift_code' => 'nullable|string',
            'entity.bank_account.account_number' => 'nullable|string',
            'entity.billing_address' => 'nullable|array',
            'entity.billing_address.recipient_name' => 'nullable|string',
            'entity.billing_address.address_1' => 'nullable|string',
            'entity.billing_address.address_2' => 'nullable|string',
            'entity.billing_address.po_box' => 'nullable|string',
            'entity.billing_address.district' => 'nullable|string',
            'entity.billing_address.city' => 'nullable|string',
            'entity.billing_address.state' => 'nullable|string',
            'entity.billing_address.zip_code' => 'nullable|string',
            'entity.billing_address.country' => 'nullable|string',
            'documents' => 'nullable|array',
            'documents.*' => 'nullable|array',
            'documents.*.type' => 'nullable|string|in:License,Agreement,Trademark',
            'documents.*.number' => 'nullable|string',
            'documents.*.issuing_country' => 'nullable|string',
            'documents.*.issuing_date' => 'nullable|date_format:Y-m-d',
            'documents.*.expiry_date' => 'nullable|date_format:Y-m-d',
            'documents.*.files' => 'nullable|array',
            'contact_person' => 'nullable|array',
            'contact_person.name.title' => 'nullable|string',
            'contact_person.name.first' => 'nullable|string',
            'contact_person.name.middle' => 'nullable|string',
            'contact_person.name.last' => 'nullable|string',
            'contact_person.contact_info' => 'nullable|array',
            'contact_person.contact_info.primary.email' => 'nullable|string',
            'contact_person.contact_info.primary.phone' => 'nullable|string',
            'contact_person.nationality' => ['nullable','string',new Two],
            'contact_person.date_of_birth' => 'nullable|date_format:Y-m-d',
            'contact_person.is_authorized' => 'nullable|boolean',
            'contact_person.authorization' => 'nullable|array',
            'contact_person.authorization.name.title' => 'nullable|string',
            'contact_person.authorization.name.first' => 'nullable|string',
            'contact_person.authorization.issuing_country' => 'nullable|string',
            'contact_person.authorization.issuing_date' => 'nullable|date_format:Y-m-d',
            'contact_person.authorization.expiry_date' => 'nullable|date_format:Y-m-d',
            'contact_person.authorization.files' => 'nullable|array',
            'contact_person.identification' => 'nullable|array',
            'contact_person.identification.*' => 'nullable|array',
            'contact_person.identification.*.name.title' => 'nullable|string',
            'contact_person.identification.*.name.first' => 'nullable|string',
            'contact_person.identification.*.name.middle' => 'nullable|string',
            'contact_person.identification.*.name.last' => 'nullable|string',
            'contact_person.identification.*.type' => 'nullable|string',
            'contact_person.identification.*.number' => 'nullable|string',
            'contact_person.identification.*.issuing_country' => 'nullable|string',
            'contact_person.identification.*.issuing_date' => 'nullable|date_format:Y-m-d',
            'contact_person.identification.*.expiry_date' => 'nullable|date_format:Y-m-d',
            'contact_person.identification.*.files' => 'nullable|array',
            'brands' => 'required|array',
            'brands.*' => 'required|array',
            'brands.*.name.en' => 'required|string',
            'brands.*.name.ar' => 'nullable|string',
            'brands.*.sector' => 'nullable|array',
            'brands.*.website' => 'nullable|string|url',
            'brands.*.social' => 'nullable|array',
            'brands.*.social.*' => 'nullable|string|url',
            'brands.*.logo' => 'nullable|string',
            'brands.*.content.tag_line.en' => 'nullable|string',
            'brands.*.content.tag_line.ar' => 'nullable|string',
            'brands.*.content.about.en' => 'nullable|string',
            'brands.*.content.about.ar' => 'nullable|string',
            'post.url' => 'nullable|string|url',
            'metadata.mtd' => 'nullable|string',
        ];
    }
    
}