<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'sku',
        'price',
        'quantity',
        'category_id',
        'branch_id',
        'status',
    ];

    public $translatable = ['name', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

}
