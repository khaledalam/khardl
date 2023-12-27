<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class DeliveryCompany extends Model
{
    protected $table = 'delivery_company';

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
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
