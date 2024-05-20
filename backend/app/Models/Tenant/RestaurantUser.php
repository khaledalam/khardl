<?php

namespace App\Models\Tenant;

use App\Models\ROSubscription;
use App\Models\ROSubscriptionInvoice;
use Carbon\Carbon;

use App\Models\Tenant\Branch;
use App\Utils\ResponseHelper;
use App\Packages\Msegat\Msegat;
use Database\Factories\tenant\RestaurantUserFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Packages\TapPayment\Customer\Customer as CustomerTap;

class RestaurantUser extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guard_name = 'web';
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'status',
        'phone_verified_at',
        'last_login',
        'address',
        'lat',
        'lng',
        'branch_id',
        'msegat_id_verification',
        'tap_customer_id',
        'tap_verified',
        'loyalty_points',
        'cashback',
        'default_lang',
        'device_token',
        'vehicle_number',
        'image',
        'verified_phone'
    ];
    const STATUS = [
        self::ACTIVE,
        self::INACTIVE,
        self::SUSPENDED,
        self::REJECTED,
    ];
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    const SUSPENDED = 'suspended';
    const REJECTED = 'rejected';

    protected $dateFormat = 'Y-m-d H:i:s';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_login' => 'date:Y-m-d'
    ];
    public function hasPermission($permission)
    {
        if ($this->isRestaurantOwner())
            return true;
        if($this->isWorker()){
            return DB::table('permissions_worker')->where('user_id', $this->id)->value($permission) === 1;
        }
        return false;
    }
    public function isRestaurantOwner()
    {
        return $this->hasRole("Restaurant Owner");
    }
    public function isDriver()
    {
        return $this->hasRole("Driver");
    }
    public function isCustomer()
    {
        return $this->roles->Empty();
    }
    public function isWorker()
    {
        return $this->hasRole("Worker");
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function getTapCustomerId()
    {
        if($this->tap_customer_id ?? null) return $this->tap_customer_id;
        return CustomerTap::createWithModel($this);
    }
    public function getImageAttribute()
    {
        if(!isset($this->attributes['image']))return null;
        return getImageFromTenant($this->attributes['image']);
    }
    public function getPhoneWithoutCountryCodeAttribute()
    {
        return substr($this->phone, 3);
    }
    public function getCountUnreadNotificationsAttribute()
    {
        $countUnRead = $this->notifications()->orderByDesc('created_at')->where('read_at', null)->count();

        return $countUnRead;
    }
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class,'roles');
    // }
    /* Scopes */
    public function scopeDrivers()
    {
        return $this->whereHas('roles',function($q){
            return $q->where('name','Driver');
        });
    }
    public function scopeWorkers()
    {
        return $this->whereHas('roles',function($q){
            return $q->where('name','Worker');
        });
    }
    public function scopeActiveDrivers()
    {
        return $this->whereHas('roles',function($q){
            return $q->where('name','Driver');
        })->where('status','active');
    }
    public function scopeCustomers($query)
    {
        return $query->whereDoesntHave('roles');
    }
    public function scopeWhenSearch($query,$search)
    {
        return $query->when($search != null, function ($q) use ($search) {
            return $q->where('first_name', 'like', '%' . $search . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%')
            ->orWhere('vehicle_number', 'like', '%' . $search . '%')
            ->orWhere('address', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
        });
    }
    public function scopeWhenStatus($query,$status)
    {
        return $query->when($status != null, function ($q) use ($status) {
            return $q->where('status', 'like',$status);
        });
    }
    public function scopeWhenBranch($query,$branch_id)
    {
        return $query->when($branch_id!= null, function ($q) use ($branch_id) {
            return $q->where('branch_id',$branch_id);
        });
    }
    /* Scopes */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
    public function driver_orders(): HasMany
    {
        return $this->hasMany(Order::class, 'driver_id', 'id');
    }
    public function completed_orders(): HasMany
    {
        return $this->hasMany(Order::class, 'driver_id', 'id')->where('status',Order::COMPLETED);
    }
    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'user_id', 'id');
    }
    public function default_address()
    {
        return $this->hasMany(UserAddress::class, 'user_id', 'id')->where('default',true)->first();
    }
    public function monthly_orders()
    {
        return $this->completed_orders->whereBetween('created_at',
        [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ]);
    }
    public function cart(){
        return $this->hasOne(Cart::class,'user_id');
    }
    public function recent_orders()
    {
        return $this->orders()->orderBy('id', 'DESC');
    }
    public function ROSubscription()
    {
        return $this->hasOne(ROSubscription::class,'user_id','id');
    }
    public function ROSubscriptionInvoices()
    {
        return $this->hasMany(ROSubscriptionInvoice::class,'user_id','id')->orderBy('id','DESC');
    }
    public function hasPermissionWorker($permission)
    {
        if ($this->isRestaurantOwner())
            return true;
        return DB::table('permissions_worker')->where('user_id', $this->id)->value($permission) === 1;
    }
    public function hasPermissionDriver($permission)
    {
        if ($this->isRestaurantOwner())
            return true;
        return DB::table('permissions_driver')->where('user_id', $this->id)->value($permission) === 1;
    }
    public function hasVerifiedPhone(): bool
    {
        return $this->phone_verified_at != null;
    }
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class,'user_coupons','user_id');
    }
    public function generateVerificationSMSCode()
    {
        $this->newAttempt();
        $response = Msegat::sendOTP(
            number: $this->phone
        );

        return ($response['http_code'] == ResponseHelper::HTTP_OK) ? $response['message']['id'] : false;
    }

    public function checkVerificationSMSCode(string $otp)
    {
        $this->newAttempt();
        $response = Msegat::verifyOTP(
            otp: $otp,
            id: $this->msegat_id_verification
        );
        if ($response['http_code'] == ResponseHelper::HTTP_OK) {
            DB::table('phone_verification_tokens')->where('user_id', $this->id)->delete();
            $this->phone_verified_at = now();
            $this->status = RestaurantUser::ACTIVE;
            $this->save();
            return true;
        }
        return false;
    }

    public function newAttempt()
    {
        // TODO need to refactor + test it's right or not
        $attempt = DB::table('phone_verification_tokens')
            ->where([
                ['user_id', '=', $this->id],
                ['created_at', '>=', Carbon::now()->subMinutes(15)]
            ])->first();

        if ($attempt) {
            DB::table('phone_verification_tokens')
                ->where('id', '=', $attempt?->id)
                ->update([
                    'created_at' => Carbon::now(),
                    'attempts' => $attempt->attempts + 1,
                ]);
            return;
        }

        DB::table('phone_verification_tokens')
            ->updateOrInsert([
                'user_id' => $this->id,
                'created_at' => Carbon::now(),
            ],
            [
                'attempts' => DB::raw('attempts + 1'),
            ]);
    }

    public function number_of_available_branches(): int
    {
        if($this->ROSubscription?->number_of_branches){
            return $this->ROSubscription?->number_of_branches;
        }
        return 0;
    }

    public function updateLastLogin()
    {
        $this->last_login = now();
        $this->save();
    }
    public function tap_verified(): bool
    {
        return $this->tap_verified;
    }
    public function changeStatus($status)
    {
        if (in_array($status, self::STATUS)) {
            $this->status = $status;
            $this->save();
        }
    }
    protected static function newFactory()
    {
      return RestaurantUserFactory::new();
    }

    public function isRejected(): bool
    {
        return $this->status == self::REJECTED;
    }
}

