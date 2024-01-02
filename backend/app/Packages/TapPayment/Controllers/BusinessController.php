<?php

namespace App\Packages\TapPayment\Controllers;

use App\Http\Controllers\Controller;
use App\Packages\TapPayment\Business\Business;
use App\Packages\TapPayment\Requests\CreateBusinessRequest;

class BusinessController extends Controller
{
    public function store(CreateBusinessRequest $request){
        return Business::create($request->validated());
    }
    public function show($business_id){
        return Business::retrieve($business_id);
    }
    public static function dummy_data(){
        return [
            'name' => [
                'en' => 'Flexwares',
                'ar' => 'فلكس ويرزدفع'
            ],
            'type' => 'corp',
            'entity' => [
                'legal_name' => [
                    'en' => 'Flexwares',
                    'ar' => 'فلكس ويرزدفع'
                ],
                'is_licensed' => true,
                'license' => [
                    'type' => 'Commercial Registration',
                    'number' => '2134342SE',
                ],
                'not_for_profit' => false,
                'country' => 'KW',
                'tax_number' => '1234567890',
                'bank_account' => [
                    'iban' => 'INBNK00045545555555555555',
                    'swift_code' => 'SWFT12345678909836435647',
                    'account_number' => 'DFGHGFVB876215bsdjhkn',
                ],
                'billing_address' => [
                    'recipient_name' => 'test',
                    'address_1' => 'Address one',
                    'address_2' => 'Address two',
                    'po_box' => '0000',
                    'district' => 'Salmiya',
                    'city' => 'Hawally',
                    'state' => 'Kuwait',
                    'zip_code' => '30003',
                    'country' => 'KW',
                ],
            ],
            'contact_person' => [
                'name' => [
                    'title' => 'Mr',
                    'first' => 'Test',
                    'middle' => 'Test',
                    'last' => 'Test',
                ],
                'contact_info' => [
                    'primary' => [
                        'email' => 'test@test.com',
                        'phone' => [
                            'country_code' => '965',
                            'number' => '51234567',
                        ],
                    ],
                ],
                'nationality' => 'KW',
                'date_of_birth' => '2000-01-02',
                'is_authorized' => true,
                'authorization' => [
                    'name' => [
                        'title' => 'Mr',
                        'first' => 'Test',
                        'middle' => 'Test',
                        'last' => 'Test',
                    ],
                    'type' => 'identity_document',
                    'issuing_country' => 'KW',
                    'issuing_date' => '2012-03-03',
                    'expiry_date' => '2020-03-03',
                    'files' => ['file_984450183956131840'],
                ],
            ],
            'post' => [
                'url' => 'http://flexwares.company/post_url',
            ],
            'metadata' => [
                'mtd' => 'metadata',
            ],
        ];
    }
}
