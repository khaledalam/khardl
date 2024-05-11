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
        'branch_id',
        'total',
        'coupon_id'

    ];

    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class)->orderBy('id','desc');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function canPayWithLoyaltyPoints(): bool
    {
        if ($this->items()->count() < 1) {
            return false;
        }

        foreach ($this->items()->get() as $cart_item) {
            if (!$cart_item->item->allow_buy_with_loyalty_points) {
                return false;
            }
        }

        return true;
    }


}
