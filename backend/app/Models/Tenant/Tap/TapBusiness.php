<?php

namespace App\Models\Tenant\Tap;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapBusiness extends Model
{
    use HasFactory;
    protected $fillable = [
        'data',
        'business_id',
        'user_id',
        'destination_id'
    ];
    protected $casts =[
        'data'=>'array'
    ];
}
