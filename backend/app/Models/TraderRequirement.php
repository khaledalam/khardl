<?php

namespace App\Models;

use Database\Factories\TraderRequirementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderRequirement extends Model
{
    use HasFactory;
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
        'national_id_number',
        'commercial_registration_number',
        'bank_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected static function newFactory()
    {
      return TraderRequirementFactory::new();
    }
    public function getCountFilesAttribute()
    {
        $count = 0;
        if($this->commercial_registration)$count++;
        if($this->tax_registration_certificate)$count++;
        if($this->bank_certificate)$count++;
        if($this->identity_of_owner_or_manager)$count++;
        if($this->national_address)$count++;
        return $count;
    }
}
