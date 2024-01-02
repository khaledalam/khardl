<?php

namespace App\Models\Tenant;

use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\StreetLine\StreetLine;
use App\Packages\DeliveryCompanies\Yeswa\Yeswa;
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
    function getModuleAttribute()
    {
        return match($this->attributes['module']){
            class_basename(Cervo::class)=> new Cervo($this),
            class_basename(StreetLine::class) => new StreetLine($this),
            class_basename(Yeswa::class) => new Yeswa($this),
            default => null
        };
    }



}
