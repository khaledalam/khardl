<?php

namespace App\Models\Tenant;

use App\Models\ROSubscription;
use App\Models\ROSubscriptionInvoice;
use Carbon\Carbon;

use App\Models\Tenant\Branch;
use App\Utils\ResponseHelper;
use App\Packages\Msegat\Msegat;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'default_lang'
    ];
    const STATUS = [
        self::ACTIVE,
        self::INACTIVE,
        self::SUSPENDED,
    ];
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    const SUSPENDED = 'suspended';
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
        return DB::table('permissions_worker')->where('user_id', $this->id)->value($permission) === 1;
    }
    public function isRestaurantOwner()
    {
        return $this->hasRole("Restaurant Owner");
    }
    public function isWorker()
    {
        return $this->hasRole("Worker");
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function getPhoneWithoutCountryCodeAttribute()
    {
        return substr($this->phone, 3);
    }
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class,'roles');
    // }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
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
    public function scopeCustomers($query)
    {
        return $query->whereDoesntHave('roles');
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
            $this->status = 'active';
            $this->save();
            return true;
        }
        return false;
    }

    public function newAttempt()
    {
        DB::table('phone_verification_tokens')->updateOrInsert([
            'user_id' => $this->id,
            'created_at' => Carbon::today(),
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
}

