<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProductExtra extends Model
{
    use HasTranslations;

    protected $table = 'product_extras';

    protected $fillable = ['name', 'price'];

    public $translatable = ['name'];

    public function orderItems()
    {
        return $this->belongsToMany(OrderItem::class, 'order_item_extras');
    }
}
