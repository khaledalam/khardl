<?php

namespace App\Packages\TapPayment\Requests;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Http\FormRequest;


class CreateLeadRequest  extends FormRequest
{
   /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $stopOnFirstFailure = true;
    public function rules()
    {


        return [

            'brand.name.ar' => 'required|string',
            'brand.name.en' => 'required|string',

            'brand.channel_services.0.channel' => 'required|string',
            'brand.channel_services.0.address' => 'required|string',
            // TODO @todo validation for terms


            'entity.country' => 'required|string',
            'entity.license.number' => 'required|string',
            'entity.license.country' => 'required|string',
            'entity.license.city' => 'required|string',
            'entity.license.type' => 'required|string',

            'entity.is_licensed' => 'sometimes|nullable|boolean',

            'brand.operations.sales.period' => 'required|string',
            'brand.operations.sales.range.from' => 'required|string',
            'brand.operations.sales.range.to' => 'required|string',
            'brand.operations.sales.currency' => 'required|string',

            'user.phone.0.country_code' => 'required|string',
            'user.phone.0.number' => 'required|string',
            'user.phone.0.type' => 'required|string',
            // 'user.phone.0.primary' => 'sometimes|nullable|boolean',

            'user.name.middle' => 'required|string',
            'user.name.last' => 'required|string',
            'user.name.lang' => 'required|string',
            'user.name.title' => 'required|string',
            'user.name.first' => 'required|string',

            'user.address.0.country' => 'required|string',
            'user.address.0.city' => 'required|string',
            /* 'user.address.0.type' => 'required|string', */
            'user.address.0.zip_code' => 'required|string',

            'user.address.0.line1' => 'required|string',
            'user.address.0.line2' => 'required|nullable',


            'user.identification.number' => 'required|string',
            'user.identification.type' => 'required|string',
            'user.identification.issuer' => 'required|string',

            'user.nationality' => 'required|string',



            'user.birth.country' => 'required|string',
            'user.birth.city' => 'required|string',
            'user.birth.date' => 'required|string|date_format:Y-m-d',

            'user.email.0.address' => 'required|string',
            /* 'user.email.0.type' => 'required|string', */





            // 'user.email.0.primary' => 'sometimes|nullable|boolean',


            'wallet.bank.name' => 'required|string',
            'wallet.bank.account.number' => 'required|string',
            'wallet.bank.account.iban' => 'required|string',
            'wallet.bank.account.name' => 'required|string',
            'wallet.bank.account.swift' => 'required|string',

            'user.primary' => 'required|boolean',

            'platforms.*' => 'required|string',

            'payment_provider.technology_id' => 'required|string',
            // 'payment_provider.settlement_by' => 'required|string',
        ];
    }
    public function prepareForValidation()
    {
        // TODO @todo ( refactor ) 
        $defaults = [
            'brand' => [
                'operations' => [
                    'sales' => [
                        'period' => 'monthly',
                        'currency' => 'SAR',

                    ],
                ],
                'channel_services' => [
                    [
                        'channel' => 'website',
                        'address'=> route('home')
                    ]
                ],
                "terms"=> [
                    [
                        "term"=> "general",
                        "agree"=> true
                    ],
                    [
                        "term"=> "chargeback",
                        "agree"=> true
                    ],
                    [
                        "term"=> "refund",
                        "agree"=> true
                    ]
                ],

            ],
            'entity' => [
                'country' => 'SA',
                'license' => [
                    'country' => 'SA',
                    'type' => 'commercial_registration',
                ],
            ],
            'user' => [
                    'address' => [
                        'country' => 'SA',
                        'type' => $this->user['phone']['type'] ?? 'HOME'
                    ],
                    'identification' => [
                        'type' => 'national_id',
                        'issuer' => $this->user['nationality'] ?? ''
                    ],
                    'phone' => [
                        'country_code' => '966',
                    ],
                    'name' => [
                        'lang' => app()->getLocale(),
                    ],
                    'primary' => true,
                    'email' => [
                        'type' => $this->user['phone']['type'] ?? 'WORK'
                    ]
                ],
                'platforms'=>[
                    env('TAP_PLATFORM_ID')
                ],
                'payment_provider' => [
                    'technology_id' => env('TAP_PAYMENT_TECHNOLOGY_ID'),
                ],
            ];


        $this->merge([
            'brand' => array_merge_recursive($defaults['brand'], $this->brand),
            'entity' => array_merge_recursive($defaults['entity'], $this->entity),
            'user' => array_merge_recursive($defaults['user'], $this->user),
            'payment_provider' => $defaults['payment_provider'],
            'platforms'=>$defaults['platforms']
        ]);
        $this->merge([

            'user'=>array_merge($this->user,
                [
                    'address'=>[ $this->user['address']],
                    'phone'=>[
                        array_merge($this->user['phone'],
                        [
                            'primary'=>true
                        ]
                        )
                    ],
                    'email'=>[
                        array_merge($this->user['email'],
                    [
                        'primary'=>true
                    ]
                    )],
            ]),
            'entity'=>array_merge($this->entity,[
                'is_licensed'=>($this->is_licensed)?true:false
            ])

        ]);


    }

}
