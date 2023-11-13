<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Branch extends Model
{
    // use HasTranslations;

    protected $table = 'branches';

    protected $fillable = [
        'name',
        'lat',
        'lng',
        'is_primary',
        'monday_open',
        'monday_close',
        'monday_closed',
        'tuesday_open',
        'tuesday_close',
        'tuesday_closed',
        'wednesday_open',
        'wednesday_close',
        'wednesday_closed',
        'thursday_open',
        'thursday_close',
        'thursday_closed',
        'friday_open',
        'friday_close',
        'friday_closed',
        'saturday_open',
        'saturday_close',
        'saturday_closed',
        'sunday_open',
        'sunday_close',
        'sunday_closed',
    ];
   

    // public $translatable = ['name'];


}
