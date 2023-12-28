<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DeliveryCompany extends Model
{
    use HasTranslations;
    protected $table = 'delivery_companies';
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
        'api_key',
        'api_doc_url',
        'api_url',
        //  TODO @todo no need for both of those fields 
        'secret_key',
       
       
    ];

    public $translatable = ['name', 'description'];



}
