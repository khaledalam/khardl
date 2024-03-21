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
        $rules = [

            'brand.name.ar' => 'required|string',
            'brand.name.en' => 'required|string',

            'brand.channel_services.0.channel' => 'required|string',
            'brand.channel_services.0.address' => 'required|string',

            'brand.logo'=>"required|mimes:jpeg,bmp,png,gif,svg,pdf",

            'brand.operations.sales.currency' => 'required|string',

            'entity.country' => 'required|string',
            'entity.is_licensed' => 'nullable|boolean',

            'wallet.bank.name' => 'required|string',
            'wallet.bank.account.number' => 'required|string',
//            'wallet.bank.account.iban' => 'required|string', // fetch from backend reg. step-2
            'wallet.bank.account.name' => 'required|string',
            'wallet.bank.documents' => 'required|array',
            'wallet.bank.documents.*.type' => 'required|string',
            'wallet.bank.documents.*.number' => 'required|string',
            'wallet.bank.documents.*.issuing_country' => 'required|string',
            'wallet.bank.documents.*.issuing_date' => 'required|date',
            'wallet.bank.documents.*.images' => 'required|array',
            'wallet.bank.documents.*.images.*' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf',

            'user.name.last' => 'required|string',
//            'user.name.title' => 'required|string', // fetch from backend reg. step-2
            'user.name.first' => 'required|string',

            'user.email.0.address' => 'required|string',
//            'user.email.0.type' => 'required|string', // WORK

            'user.phone.0.country_code' => 'required|string',
            'user.phone.0.number' => 'required|string',
//            'user.phone.0.type' => 'required|string', // WORK


            'platforms.*' => 'required|string',
            // 'payment_provider.technology_id' => 'required|string',
        ];
        if ($this->input('entity.is_licensed')) {
            $rules = array_merge($rules, [
                'entity.license.number' => 'required|string',
                'entity.license.country' => 'required|string',
                'entity.license.type' => 'required|string',
                'entity.license.documents' => 'required|array',
                'entity.license.documents.*.type' => 'required|string',
                'entity.license.documents.*.number' => 'required|string',
                'entity.license.documents.*.issuing_country' => 'required|string',
                'entity.license.documents.*.issuing_date' => 'required|date',
                'entity.license.documents.*.expiry_date' => 'required|date',

            ]);
        }
        return $rules;
    }
    public function prepareForValidation()
    {
        $defaults = [
            'brand' => [

                'operations' => [
                    'sales' => [
                        'currency' => 'SAR',
                    ],
                ],
                'logo'=>$this->brand['logo'] ?? null,
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
                'name'=>[
                    'ar'=>$this->brand['name']['ar']?? null,
                    'en'=>$this->brand['name']['en']?? null,
                ],
                'channel_services' => [
                    [
                        'channel' => 'website',
                        'address'=> route('home')
                    ]
                ],
            ],
            'wallet' => [
               'bank'=>[
                    "name"=> $this->wallet['bank']['name'] ?? null,
                    "account"=>[
                        "number"=> $this->wallet['bank']['account']['number'] ?? null,
                        "iban"=> $this->wallet['bank']['account']['iban'] ?? null,
                        "name"=> $this->wallet['bank']['account']['name'] ?? null,
                    ],
                    'documents'=>[
                        [
                            "type"=> "Bank Statement",
                            "issuing_country"=> "SA",
                            "number"=> $this->wallet['bank']['documents'][0]['number'] ?? null,
                            "issuing_date"=> $this->wallet['bank']['documents'][0]['issuing_date'] ?? null,
                            "images"=> [
                                $this->wallet['bank']['documents'][0]['images'][0] ?? null,
                            ]
                        ]
                    ]

               ]
            ],
            'entity' => [
                'country' => 'SA',
                "is_licensed" => ($this->entity['is_licensed'] ?? false)?true:false,
            ],
            'user' => [

                    'phone' => [
                        [
                        'country_code' => '966',
                        "number"=> $this->user['phone']['number'] ?? null,
                        "type"=> $this->user['phone']['type'] ?? null,
                        "primary"=> true
                        ]
                    ],
                    'name' => [
                        "title"=>$this->user['name']['title'] ?? null,
                        "first"=>$this->user['name']['first'] ?? null,
                        "last"=>$this->user['name']['last'] ?? null,
                    ],
                    'email' => [
                      [
                        'type' =>  $this->user['email']['type'] ?? null,
                        "address"=>$this->user['email']['address'] ?? null,
                        "primary"=> true
                      ]
                    ]
                ],
                'platforms'=>[
                    env('TAP_PLATFORM_ID')
                ],
                // 'payment_provider' => [
                //     'technology_id' => env('TAP_PAYMENT_TECHNOLOGY_ID'),
                // ],
            ];
        if($this->entity['is_licensed'] ?? false){
            $defaults['entity']['license']= [
                'country' => 'SA',
                'type' => 'commercial_registration',
                "number"=>$this->entity['license']['number'] ?? null,
                "documents"=>[
                   [
                    "type"=> "Memorandum of Association",
                    "issuing_country"=> "SA",
                    "number"=> $this->entity['license']['documents'][0]['number'] ?? null,
                    "issuing_date"=>  $this->entity['license']['documents'][0]['issuing_date'] ?? null,
                    "expiry_date"=> $this->entity['license']['documents'][0]['expiry_date'] ?? null,
                   ]
                ]
            ];
        }

        $this->replace($defaults);

    }

}
