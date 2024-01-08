<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory,HasTranslations;
    protected $fillable = [
        'amount',
        'name'
    ];
    public $translatable = ['name'];
    
}
