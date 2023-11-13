<?php

namespace App\Models\Tenant;

use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    protected $table = 'wishlists';

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
