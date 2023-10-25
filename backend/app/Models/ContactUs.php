<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';

    protected $fillable = [
        'email',
        'phone_number',
        'business_name',
        'responsible_person_name'
    ];
}
