<?php

namespace App\Packages\TapPayment\Requests;

use LVR\CountryCode\Two;
use Illuminate\Foundation\Http\FormRequest;
use LVR\CountryCode\Three;

class CreateFileRequest  extends FormRequest
{
   /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|file',
            'purpose' => 'required|string|in:business_icon,business_logo,customer_signature,dispute_evidence,finance_report_run,identity_document,pci_document,sigma_scheduled_query,tax_document_user_upload',
            'title' => 'required|string',
        ];
    }
    
}