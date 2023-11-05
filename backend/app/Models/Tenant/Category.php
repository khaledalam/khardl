<?php

namespace App\Models\Tenant;

use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\EloquentSortable\SortableTrait;

class Category extends Model
{
    use HasTranslations,HasTranslatableSlug,SortableTrait;

    protected $table = 'categories';

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];


    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'image_path',
        'slug',
        'sort_order',
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
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
