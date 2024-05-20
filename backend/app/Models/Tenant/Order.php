<?php

namespace App\Models\Tenant;

use App\Models\Tenant;
use App\Observers\OrderObserver;
use Carbon\Carbon;
use Database\Factories\tenant\OrderFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

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
        'tap_payment_method',
        'refund_id',
        'accepted_at',
        'total_loyalty_points'
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

        self::creating(function ($model) use ($tenant_id) {

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
            } while ($order);

            $model->id = $ID;
        });
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    public function getTaxAmountAttribute()
    {
        return number_format((($this->subtotal - $this->discount) * $this->vat) / 100, 2, '.', '');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    public function getCancelableAttribute()
    {
        if ($this->isDelivery()) {
            if ($this->deliver_by == 'Yeswa') {
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
    public function scopeRejected($query)
    {
        return $query->where('status', self::REJECTED);
    }
    public function scopeDriverOrders($query)
    {
        return $query->whereHas('delivery_type', function ($q) {
            return $q->where('name', DeliveryType::DELIVERY);
        })
        ->where('status','!=', self::PENDING)
        ->where('status','!=', self::REJECTED)
        ->whereHas('branch', function($q){
            return $q->where('drivers_option',true);
        })
        ->where('branch_id', getAuth()->branch_id);
    }
    public function scopeOnlineCash($query)
    {
        return $query->whereHas('payment_method', function ($q) {
            return $q->where('name', PaymentMethod::ONLINE);
        });
    }
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
    public function scopeRecentUpdated($query)
    {
        return $query->orderBy('updated_at', 'DESC');
    }
    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search != null, function ($q) use ($search) {
            return $q->where('shipping_address', 'LIKE', '%' . $search . '%')
                ->orWhere('city', 'LIKE', '%' . $search . '%')
                ->orWhere('region', 'LIKE', '%' . $search . '%')
                ->orWhere('country', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%');
        });
    }
    public function scopeWhenStatus($query, $status)
    {
        return $query->when($status != null, function ($q) use ($status) {
            return $q->where('status', $status);
        });
    }
    public function scopeWhenDriverStatus($query, $status)
    {
        return $query->when($status != null, function ($q) use ($status) {
            if($status=='history'){
                return $q->where('status', self::COMPLETED)->orWhere('status', self::CANCELLED);
            }elseif($status == 'assigned'){
                return $q->where(function ($query) {
                    $query->where('status', self::READY)
                    ->orWhere('status', self::RECEIVED_BY_RESTAURANT);
                })->where('driver_id', getAuth()->id);
            }elseif($status == self::ACCEPTED || $status == self::COMPLETED || $status == self::CANCELLED){
                return $q->where('status', $status);
            }
        });
    }
    public function scopeWhenDateString($query, $date)
    {
        return $query->when($date != null, function ($q) use ($date) {
            if ($date == 'today') {
                request()->merge(['start_date' => now()->toDateString()]);
                request()->merge(['end_date' => now()->toDateString()]);
                return $q->whereDate('created_at', now()->toDateString());
            } elseif ($date == 'last_day') {
                request()->merge(['start_date' => now()->subDay()->toDateString()]);
                request()->merge(['end_date' => now()->subDay()->toDateString()]);
                return $q->whereDate('created_at', now()->subDay()->toDateString());
            } elseif ($date == 'this_week') {
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                request()->merge(['start_date' => $startDate?->format('Y-m-d')]);
                request()->merge(['end_date' => $endDate->format('Y-m-d')]);
                return $q->whereBetween('created_at', [$startDate, $endDate]);
            } elseif ($date == 'last_week') {
                $startDate = Carbon::now()->subDays(7)->startOfDay();
                $endDate = Carbon::now()->subDays(1)->endOfDay();
                request()->merge(['start_date' => $startDate?->format('Y-m-d')]);
                request()->merge(['end_date' => $endDate->format('Y-m-d')]);
                return $q->whereBetween('created_at', [$startDate, $endDate]);
            }  elseif ($date == 'this_month') {
                $startOfMonth = now()->startOfMonth();
                $endOfMonth = now()->endOfMonth();
                request()->merge(['start_date' => $startOfMonth?->format('Y-m-d')]);
                request()->merge(['end_date' => $endOfMonth->format('Y-m-d')]);
                return $q->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
            } elseif ($date == 'last_month') {
                $startOfLastMonth = now()->subMonth()->startOfMonth();
                $endOfLastMonth = now()->subMonth()->endOfMonth();
                request()->merge(['start_date' => $startOfLastMonth?->format('Y-m-d')]);
                request()->merge(['end_date' => $endOfLastMonth->format('Y-m-d')]);
                return $q->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth]);
            } elseif ($date == 'this_year') {
                $startOfYear = now()->startOfYear();
                $endOfYear = now()->endOfYear();
                request()->merge(['start_date' => $startOfYear?->format('Y-m-d')]);
                request()->merge(['end_date' => $endOfYear->format('Y-m-d')]);
                return $q->whereBetween('created_at', [$startOfYear, $endOfYear]);
            } elseif ($date == 'last_year') {
                $startOfLastYear = now()->subYear()->startOfYear();
                $endOfLastYear = now()->subYear()->endOfYear();
                request()->merge(['start_date' => $startOfLastYear?->format('Y-m-d')]);
                request()->merge(['end_date' => $endOfLastYear->format('Y-m-d')]);
                return $q->whereBetween('created_at', [$startOfLastYear, $endOfLastYear]);
            }
        });
    }
    public function scopeWhenDateRange($query, $from, $to)
    {
        return $query->when($from != null && $to != null, function ($q) use ($from, $to) {
            return $q->whereBetween('created_at', [$from, $to]);
        });
    }
    public function scopeWhenPaymentStatus($query, $status)
    {
        return $query->when($status != null, function ($q) use ($status) {
            return $q->where('payment_status', $status);
        });
    }
    public function scopeWhenPermissions($query)
    {
        $user = Auth::user();
        if($user->isRestaurantOwner())return $query;
        else{
            return $query->where('branch_id',$user->branch_id);
        }
    }
    public function scopeShouldLimitDrivers($query)
    {
        return $query->when($this->hasDeliveryAllOptions(clone $query), function ($query) {
            $settings = Setting::first();
            $limitDrivers = $settings->limit_delivery_company ?? config('application.limit_delivery_company', 15);

            return $query->where('received_by_restaurant_at', '>', now()->subMinutes($limitDrivers));
        });
    }

    public function scopeShouldAssignDriver($query)
    {
        return $query->when(!$this->hasDeliveryAllOptions(clone $query), function ($query) {
            return $query->where('driver_id', null);
        });
    }

    private function hasDeliveryAllOptions($query)
    {
        return $query->whereHas('branch',function($subQ){
            return $subQ->where('delivery_companies_option',true)
            ->where('drivers_option',true);
        })->count();
    }
    /* End Scoped */
    public static function ChangeStatus($status)
    {
        return match ($status) {
            self::PENDING => [self::RECEIVED_BY_RESTAURANT, self::ACCEPTED, self::CANCELLED, self::COMPLETED, self::READY, self::REJECTED],
            self::RECEIVED_BY_RESTAURANT => [self::ACCEPTED, self::CANCELLED, self::COMPLETED, self::READY, self::REJECTED],
            self::ACCEPTED => [self::READY, self::COMPLETED, self::CANCELLED],
            self::READY => [self::COMPLETED, self::CANCELLED],
            default => []
        };
    }
    public function isDelivery()
    {
        return $this->delivery_type?->name == DeliveryType::DELIVERY;
    }
    public function isCashOnDelivery()
    {
        return $this->payment_method?->name == PaymentMethod::CASH_ON_DELIVERY;
    }

    /**
     * @TODO: make LOYALTY_POINTS same as other Payment methods to be fetched from DB and has relation.
     * currently I depend on the fact of any item has allow_buy_with_loyalty_points => true
     *
     * @return bool
     */
    public function isLoyaltyPointPayment()
    {
        return $this->payment_method?->name == PaymentMethod::LOYALTY_POINTS;
    }

    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }
    public function driver()
    {
        return $this->belongsTo(RestaurantUser::class)->whereHas('roles', function ($q) {
            return $q->where('name', 'Driver');
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
    public function getAcceptedDelivery()
    {
        $data = [];
        (!$this->cervo_ref) ?: $data[] = __('Cervo');
        (!$this->yeswa_ref) ?: $data[] = __('Yeswa');
        (!$this->streetline_ref) ?: $data[] = __('StreetLine');
        if (empty($data))
            return false;
        return implode(",", $data);
    }
    public function getDistanceAttribute()
    {
        return haversineDistance((float) $this->branch?->lat, (float) $this->branch?->lng, (float) $this->user?->lat, (float) $this->user?->lng);
    }
    public function getDriverCanAcceptAttribute()
    {
        if(($this->status == self::RECEIVED_BY_RESTAURANT || $this->status == self::READY)
            && $this->driver_id == null
            && $this->deliver_by == null
        ){
            $settings = Setting::first();
            $limitDrivers = $settings->limit_delivery_company ?? config('application.limit_delivery_company', 5);
            if($settings && $this->branch?->delivery_companies_option && $this->branch?->drivers_option && $limitDrivers > 0){
                return $this->received_by_restaurant_at > Carbon::now()->subMinutes($limitDrivers);
            }else{
                return true;
            }
        }
        return false;
    }
    public function getAssignedToMeAttribute()
    {
        return $this->driver_id == getAuth()->id;
    }
    public function getTimeRemainForRejectAttribute()
    {
        $settings = Setting::first();
        $limitDrivers = $settings->limit_delivery_company ?? config('application.limit_delivery_company', 5);
        if($settings && $this->branch?->delivery_companies_option && $this->branch?->drivers_option && $limitDrivers > 0){
        $limitDriversInSeconds = $limitDrivers * 60;
            if($this->received_by_restaurant_at){
                $receivedTime = Carbon::parse($this->received_by_restaurant_at);
                $currentTime = Carbon::now();
                $diffInSeconds = $receivedTime->diffInSeconds($currentTime);
                return ($limitDriversInSeconds - $diffInSeconds) > 0 ? ($limitDriversInSeconds - $diffInSeconds) : 0;
            }else{
                return 0;
            }
        }else{
            return null;
        }
    }

}
