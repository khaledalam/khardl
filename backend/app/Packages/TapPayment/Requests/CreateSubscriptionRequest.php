<?php

namespace App\Packages\TapPayment\Requests;

use LVR\CountryCode\Two;
use Illuminate\Foundation\Http\FormRequest;
use LVR\CountryCode\Three;

class CreateSubscriptionRequest  extends FormRequest
{
   /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'term'=>'required|array',
            'term.interval' => 'nullable|string|in:DAILY,WEEKLY,MONTHLY,BIMONTHLY,QUARTERLY,HALFYEARLY,YEARLY',
            'term.period' => 'nullable|int',
            'term.from' => 'nullable|date_format:Y-m-d\TH:i:s',
            'term.due' => 'nullable|int|in:0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28',
            'term.auto_renew' => 'nullable|boolean',
            'term.timezone' => 'nullable|string',
            'trial'=>'nullable|array',
            'trial.days' => 'nullable|int',
            'trial.amount' => 'nullable|int',
            'charge'=>'nullable|array',
            'charge.amount' => 'nullable|int',
            'charge.currency' =>  ['nullable','string',new Three],
            'charge.description' => 'nullable|string',
            'charge.statement_descriptor' => 'nullable|string',
            'charge.metadata.udf1' => 'nullable|string',
            'charge.metadata.udf2' => 'nullable|string',
            'charge.receipt.email' => 'nullable|string',
            'charge.receipt.sms' => 'nullable|string',
            'charge.customer.id' => 'nullable|string',
            'charge.source.id' => 'nullable|string',
        ];
    }
    
}