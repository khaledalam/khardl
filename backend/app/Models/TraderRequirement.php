<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TraderRequirement extends Model
{
    protected $table = 'trader_requirements';

    protected $fillable = [
        'user_id',
        'IBAN',
        'facility_name',
        'commercial_registration',
        'tax_registration_certificate',
        'bank_certificate',
        'identity_of_owner_or_manager',
        'national_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
