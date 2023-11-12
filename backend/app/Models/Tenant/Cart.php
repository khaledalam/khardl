<?php

namespace App\Models\Tenant;

use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'session_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
