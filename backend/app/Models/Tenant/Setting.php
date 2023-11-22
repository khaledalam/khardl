<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table= "settings";
    protected $fillable =[
        'is_live'
    ];
    public $timestamps = false;

}
