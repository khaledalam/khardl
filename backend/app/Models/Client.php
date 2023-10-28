<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Client extends Model
{
    use HasTranslations;

    protected $table = 'clients';

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'logo'
    ];

}
