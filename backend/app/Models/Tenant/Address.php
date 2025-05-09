<?php

namespace App\Models\Tenant;

use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'user_id',
        'name',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country',
        'phone',
        'type',
        'is_primary'
    ];

    /**
     * An address belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }

    // If you have other relationships, like for orders, you can define them here as well:

    /**
     * An address may be associated with multiple orders.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
