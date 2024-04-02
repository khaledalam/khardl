<?php

namespace App\Models\Tenant;

use App\Models\Tenant;
use App\Observers\OrderObserver;
use Carbon\Carbon;
use Database\Factories\tenant\OrderFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    public $incrementing = false;

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
        'subtotal',
        'deliver_by',
        'tracking_url',
        'yeswa_ref',
        'cervo_ref',
        'streetline_ref',
        'coupon_id',
        'discount',
        'received_by_restaurant_at',
        'driver_id',
        'reject_or_cancel_reason',
        'delivery_cost',
        'lat',
        'lng',
        'address',
        'driver_name',
        'driver_phone',
        'manual_order_first_name',
        'manual_order_last_name',
        'refund_id'
    ];
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $casts = [
        'received_by_restaurant_at' => 'datetime'
    ];
    protected $appends = ['cancelable'];
    const STATUS = [
        self::PENDING,
        self::RECEIVED_BY_RESTAURANT,
        self::ACCEPTED,
        self::CANCELLED,
        self::COMPLETED,
        self::READY,
        self::REJECTED,
    ];

    const PENDING = 'pending';
    const RECEIVED_BY_RESTAURANT = 'received_by_restaurant';
    const ACCEPTED = 'accepted';
    const CANCELLED = 'cancelled';
    const COMPLETED = 'completed';
    const READY = 'ready';
    const REJECTED = 'rejected';


    protected static function boot()
    {
        parent::boot();
        self::observe(OrderObserver::class);

        $tenant_id = tenant()->id;

        self::creating(function ($model) use($tenant_id){

            // 5 6 5
            // Tenant mapper hash - date(YY-MM-DD) - order unique hash
            
            // 5 7 => 12
            // Tenant mapper hash - order unique hash
            $prefix = Tenant::find($tenant_id)->mapper_hash;
//            $suffix = date('ymd') . generateToken();

            do {
                $suffix = generateToken(7);
                $ID = $prefix . $suffix;
                $order = Order::where('id', '=', $ID)->first();
            } while($order);

            $model->id = $ID;
        });
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    public function getTaxAmountAttribute()
    {
        return number_format((($this->subtotal - $this->discount) * $this->vat) / 100 , 2, '.', '');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    public function getCancelableAttribute()
    {
        if($this->isDelivery()){
            if($this->deliver_by == 'Yeswa'){
                return false;
            }
        }
        return true;
    }

    /* Start Scopes */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::COMPLETED);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::PENDING);
    }

    public function scopeReceivedByRestaurant($query)
    {
        return $query->where('status', self::RECEIVED_BY_RESTAURANT);
    }
    public function scopeReadyForDriver($query)
    {
        return $query->where('status', self::RECEIVED_BY_RESTAURANT)->orWhere('status', self::READY);
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', self::ACCEPTED);
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', self::CANCELLED);
    }

    public function scopeReady($query)
    {
        return $query->where('status', self::READY);
    }
    public function scopeDelivery($query)
    {
        return $query->whereHas('delivery_type',function($q){
            return $q->where('name',DeliveryType::DELIVERY);
        });
    }
    public function scopeOnlineCash($query)
    {
        return $query->whereHas('payment_method',function($q){
            return $q->where('name',PaymentMethod::ONLINE);
        });
    }
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search != null, function ($q) use ($search) {
            return $q->where('shipping_address', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%');
        });
    }
    public function scopeWhenStatus($query, $status)
    {
        return $query->when($status != null, function ($q) use ($status) {
            return $q->where('status', $status);
        });
    }
    public function scopeWhenDateString($query, $date)
    {
        return $query->when($date != null, function ($q) use ($date) {
            if ($date == 'today') {
                return $q->whereDate('created_at', now()->toDateString());
            } elseif ($date == 'last_day') {
                return $q->whereDate('created_at', now()->subDay()->toDateString());
            } elseif ($date == 'last_week') {
                $startDate = Carbon::now()->subDays(7)->startOfDay();
                $endDate = Carbon::now()->subDays(1)->endOfDay();
                return $q->whereBetween('created_at', [$startDate,$endDate]);
            }
        });
    }
    public function scopeWhenPaymentStatus($query, $status)
    {
        return $query->when($status != null, function ($q) use ($status) {
            return $q->where('payment_status', $status);
        });
    }
    /* End Scoped */
    public static function ChangeStatus($status){
        return  match($status){
            self::PENDING => [self::RECEIVED_BY_RESTAURANT,self::ACCEPTED,self::CANCELLED,self::COMPLETED,self::READY,self::REJECTED],
            self::RECEIVED_BY_RESTAURANT => [self::ACCEPTED,self::CANCELLED,self::COMPLETED,self::READY,self::REJECTED],
            self::ACCEPTED => [self::READY,self::COMPLETED,self::CANCELLED],
            self::READY => [self::COMPLETED,self::CANCELLED],
            default => []
        };
    }
    public function isDelivery()
    {
        return $this->delivery_type?->name == DeliveryType::DELIVERY;
    }
    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }
    public function driver()
    {
        return $this->belongsTo(RestaurantUser::class)->whereHas('roles',function($q){
            return $q->where('name','Driver');
        });
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

//    public function products()
//    {
//        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price_at_order_time')->withTimestamps();
//    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
    public function delivery_type()
    {
        return $this->belongsTo(DeliveryType::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    protected static function newFactory()
    {
      return OrderFactory::new();
    }
    public function getAcceptedDelivery(){
        $data = [];
        (!$this->cervo_ref)?:$data[]=__('Cervo');
        (!$this->yeswa_ref)?:$data[]=__('Yeswa');
        (!$this->streetline_ref)?:$data[]=__('StreetLine');
        if(empty($data)) return false;
        return implode(",", $data);
    }

}
