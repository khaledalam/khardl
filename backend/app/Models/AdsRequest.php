<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'price',
        'status',
        'advertisement_package_id',
        'answered_at'
    ];
}
