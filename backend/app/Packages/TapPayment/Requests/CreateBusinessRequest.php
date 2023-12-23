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
            'entity.license.type' => 'required_with:entity.license|string|in:Commercial Registration,Commercial License',
            'entity.license.number' => 'required_with:entity.license|string',
            'entity.not_for_profit' => 'nullable|boolean',
            'entity.country' => ['required','string', new Two],
            'entity.tax_number' => 'nullable|string',
            'entity.bank_account' => 'nullable|array',
            'entity.bank_account.iban' => 'required_with:entity.bank_account|string',
            'entity.bank_account.swift_code' => 'required_with:entity.bank_account|string',
            'entity.bank_account.account_number' => 'required_with:entity.bank_account|string',
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
            'entity.documents' => 'nullable|array',
            'entity.documents.*' => 'nullable|array',
            'entity.documents.*.type' => 'nullable|string|in:License,Agreement,Trademark',
            'entity.documents.*.number' => 'nullable|string',
            'entity.documents.*.issuing_country' => 'nullable|string',
            'entity.documents.*.issuing_date' => 'nullable|date_format:Y-m-d',
            'entity.documents.*.expiry_date' => 'nullable|date_format:Y-m-d',
            'entity.documents.*.files' => 'nullable|array',
            'contact_person' => 'required|array',
            'contact_person.name.title' => 'required|string',
            'contact_person.name.first' => 'required|string',
            'contact_person.name.middle' => 'required|string',
            'contact_person.name.last' => 'required|string',
            'contact_person.contact_info' => 'required|array',
            'contact_person.contact_info.primary.email' => 'required|string',
            'contact_person.contact_info.primary.phone' => 'required|array',
            'contact_person.contact_info.primary.phone.country_code' => 'required|string',
            'contact_person.contact_info.primary.phone.number' => 'required|string',
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
        ];
    }
    function prepareForValidation()
    {
        $this->merge(['entity'=>array_merge($this->entity,[
            'is_licensed'=>(isset($this->entity['is_licensed']))?true:false
        ])]);
    }
    protected function passedValidation(): void
    {
        $this->merge([
            "type"=>'ind',
        ]);
    }
    
}