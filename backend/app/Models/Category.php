<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    protected $table = 'categories';

    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'parent_id',
        'image_path',
        'slug',
        'order',
    ];

    public $translatable = ['name', 'description', 'slug'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }

    /**
     * Each category belongs to a restaurant.
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
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
