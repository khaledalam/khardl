<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DeliveryCompany extends Model
{
    use HasTranslations;
    protected $table = 'delivery_company';
    public $timestamps  = false;
    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'status',
        'extra_price',
        'coverage_km',
        'contract',
        'profile',
        'payments',
        'api_url',
        'api_key',
        'secret_key',
        'api_doc_url',
    ];

    public $translatable = ['name', 'description'];



}
