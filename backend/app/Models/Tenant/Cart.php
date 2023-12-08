<?php

namespace App\Models\Tenant;

use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    public $canCOD = true;

    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'payment_method_id',
        'branch_id',
        'total',
        'delivery_type'

    ];

    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Accept Cash on delivery payment method
    public function getCanCOD()
    {
        return true;
    }

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getFirstNameAttribute()
    {
        return ucfirst("Test");
    }

    // Accept Credit card payment method
    public function canCC()
    {
        return true;
    }
}
