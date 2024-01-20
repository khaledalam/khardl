<?php

namespace App\Packages\TapPayment\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CreateLeadRequest  extends FormRequest
{
   /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand.operations.sales.period' => 'required|string',
            'brand.operations.sales.range.from' => 'required|string',
            'brand.operations.sales.range.to' => 'required|string',
            'brand.operations.sales.currency' => 'required|string',

            'brand.terms.*.term' => 'required|string|in:general,chargeback,refund',
            'brand.terms.*.agree' => 'required|boolean',

            'brand.name.ar' => 'required|string',
            'brand.name.en' => 'required|string',

            'brand.channel_services.*.channel' => 'required|string',
            'brand.channel_services.*.address' => 'required|string|url',

            'entity.country' => 'required|string',
            'entity.license.number' => 'required|string',
            'entity.license.country' => 'required|string',
            'entity.license.city' => 'required|string',
            'entity.license.type' => 'required|string',

            'entity.is_licensed' => 'required|boolean',

            'wallet.bank.name' => 'required|string',
            'wallet.bank.account.number' => 'required|string',
            'wallet.bank.account.iban' => 'required|string',
            'wallet.bank.account.name' => 'required|string',
            'wallet.bank.account.swift' => 'required|string',

            'user.address.*.country' => 'required|string',
            'user.address.*.city' => 'required|string',
            'user.address.*.type' => 'required|string',
            'user.address.*.zip_code' => 'required|string',
            'user.address.*.postal_code' => 'required|string',
            'user.address.*.line2' => 'required|nullable',
            'user.address.*.line1' => 'required|string',

            'user.identification.number' => 'required|string',
            'user.identification.type' => 'required|string', 
            'user.identification.issuer' => 'required|string',

            'user.nationality' => 'required|string',

            'user.phone.*.country_code' => 'required|string',
            'user.phone.*.number' => 'required|string',
            'user.phone.*.type' => 'required|string',
            'user.phone.*.primary' => 'required|boolean',

            'user.name.middle' => 'required|string',
            'user.name.last' => 'required|string',
            'user.name.lang' => 'required|string',
            'user.name.title' => 'required|string',
            'user.name.first' => 'required|string',

            'user.birth.country' => 'required|string',
            'user.birth.city' => 'required|string',
            'user.birth.date' => 'required|string|date_format:Y-m-d',

            'user.email.*.address' => 'required|string',
            'user.email.*.type' => 'required|string',
            'user.email.*.primary' => 'required|boolean',

            'user.primary' => 'required|boolean',

            'platforms.*' => 'required|string',

            'payment_provider.technology_id' => 'required|string',
            // 'payment_provider.settlement_by' => 'required|string',
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'brand.operations.sales.period' => 'monthly',
            'brand.operations.sales.currency' => 'SAR',
            'brand.channel_services.0.channel' => 'website',
            'entity.country' => 'SA',
            'entity.license.country' => 'SA',
            'entity.license.type' => 'commercial_registration',
            'user.address.0.country' => 'SA',
            'user.identification.type' => 'national_id',
            'user.identification.issuer' => 'SA',
            'user.nationality' => 'SA',
            'user.phone.0.country_code' => '966',
            'user.name.lang' => 'en',
            'user.primary' => true,
            'payment_provider.technology_id' => env('TAP_Payment_Technology_ID'),
            // 'payment_provider.settlement_by' => ,
        ]);
    }
}