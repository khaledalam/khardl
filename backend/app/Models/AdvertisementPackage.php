<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class AdvertisementPackage extends Model
{
    use HasFactory, HasTranslations,SoftDeletes;
    public $translatable = ['name','description'];
    protected $fillable = [
        'name',
        'description',
        'image',
        'active',
    ];
    const STORAGE = 'advertisements_packages';
    /* start getters and setters */
    public function getImageAttribute()
    {
        $imageName = $this->attributes['image'];
        if (Storage::disk('public')->exists($imageName)) {
            // Return the URL to the image.
            return Storage::disk('public')->url($imageName);
        }
        // Return null or a default image URL if the image does not exist.
        return null;
    }
    /* end getters and setters */
}
