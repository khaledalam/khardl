<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProductSize extends Model
{
    use HasTranslations;

    protected $table = 'product_sizes';

    protected $fillable = ['name', 'price'];

    public $translatable = ['name'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
