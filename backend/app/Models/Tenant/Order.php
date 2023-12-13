<?php

namespace App\Models\Tenant;

use Carbon\Carbon;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'transaction_id',
        'user_id',
        'branch_id',
        'total',
        'status',
        'payment_method_id',
        'payment_status',
        'shipping_address',
        'order_notes',
        'delivery_type_id',
        'vat',
        'subtotal'
    ];
    protected $dateFormat = 'Y-m-d H:i:s';
    const STATUS = [
        'accepted',
        'cancelled',
        'pending',
        'completed',
        'ready'
    ];
    const ACCEPTED = 'accepted';
    const CANCELLED = 'cancelled';
    const PENDING = 'pending';
    const COMPLETED = 'completed';
    const READY = 'ready';
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }
  
    
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price_at_order_time')->withTimestamps();
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
    public function delivery_type()
    {
        return $this->belongsTo(DeliveryType::class);
    }
    
    public function items(){
        return $this->hasMany(OrderItem::class);
    }
   
}
