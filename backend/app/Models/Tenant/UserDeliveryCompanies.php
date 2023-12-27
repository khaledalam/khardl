<?php

namespace App\Models\Tenant;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserDeliveryCompanies extends Model
{
    protected $table = 'user_delivery_companies';

    protected $fillable = [
        'user_id',
        'delivery_company_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deliver_company()
    {
        return $this->belongsTo(DeliveryCompany::class);
    }
}
