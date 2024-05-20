<?php

namespace App\Models;

use App\Enums\Admin\AdsRequestsStatusEnum;
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
    protected $appends = ['image_for_tenants'];
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
    public function getImageForTenantsAttribute()
    {
        $imageName = $this->attributes['image'];
        return tenancy()->central(function () use($imageName){
            if (Storage::disk('public')->exists($imageName)) {
                // Return the URL to the image.
                return Storage::disk('public')->url($imageName);
            }
            // Return null or a default image URL if the image does not exist.
            return null;
        });
    }
    /* end getters and setters */
    /* Start scopes */
    public function scopeActive($query)
    {
        return $query->where('active',1)->orderBy('id','desc');
    }
    /* End scopes */
    /* Start relations */
    public function requests()
    {
        return $this->hasMany(AdsRequest::class);
    }
    public function pending_requests()
    {
        return $this->hasMany(AdsRequest::class)->where('status',AdsRequestsStatusEnum::PENDING);
    }
    /* end relations */
}
