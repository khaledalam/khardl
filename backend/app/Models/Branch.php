<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Branch extends Model
{
    use HasTranslations;

    protected $table = 'branches';

    protected $fillable = [
        'restaurant_id',
        'name',
        'address',
        'phone',
        'email',
        'latitude',
        'longitude',
        'is_active'
    ];

    public $translatable = ['name', 'address'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

}
