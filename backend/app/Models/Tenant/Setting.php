<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table= "settings";
    protected $fillable =[
        'is_live',
        'delivery_fee'
    ];
    public $timestamps = false;

}
