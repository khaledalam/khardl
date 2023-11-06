<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Branch extends Model
{
    use HasTranslations;

    protected $table = 'branches';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'map',
        'is_active'
    ];
    protected $cast = [
        'map'=>'json'
    ];
    // Define a mutator for the 'map' attribute
    public function setMapAttribute($value)
    {
        $this->attributes['map'] = json_encode($value);
    }
    public function getMapAttribute($value)
    {
        return json_decode($value, true);
    }

    public $translatable = ['name', 'address'];


}
