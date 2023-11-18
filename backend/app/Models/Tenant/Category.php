<?php

namespace App\Models\Tenant;

use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasTranslatableSlug;

class Category extends Model
{
    use HasTranslations,HasTranslatableSlug;

    protected $table = 'categories';


    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'image_path',
        'slug',
        'branch_id',
    ];

    public $translatable = ['name', 'description', 'slug'];
    /**
     * Get the options for generating the slug.
    */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }

    /**
     * Retrieve sub-categories (if any).
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Retrieve parent category (if exists).
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Retrieve branch (if exists).
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    /**
     * Retrieve user (if exists).
     */
    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
