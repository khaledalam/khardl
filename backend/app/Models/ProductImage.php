<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'image_path',
        'alt_text',
        'is_featured',
        'order',
    ];

    /**
     * Each image belongs to a specific product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
