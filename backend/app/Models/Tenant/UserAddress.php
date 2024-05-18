<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'lat',
        'lng',
        'default',
        'type',
        'name',
        'city',
        'region',
        'country',
        'neighbourhood'
    ];
}
