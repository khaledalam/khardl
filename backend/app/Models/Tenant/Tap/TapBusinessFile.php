<?php

namespace App\Models\Tenant\Tap;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapBusinessFile extends Model
{
    use HasFactory;
    const STORAGE = "business/files";
    protected $fillable =[
        'business_logo_path',
        'business_logo_id',
        'customer_signature_path',
        'customer_signature_id',
        'dispute_evidence_path',
        'dispute_evidence_id',
        'identity_document_path',
        'identity_document_id',
        'pci_document_path',
        'pci_document_id',
        'tax_document_user_upload_path',
        'tax_document_user_upload_id',
    ];
}
