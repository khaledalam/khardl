<?php

namespace App\Models;

use App\Models\Tenant\Branch;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Database\Factories\UserFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use App\Packages\TapPayment\Customer\Customer as CustomerTap;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use MustVerifyEmailTrait, HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guard_name = 'web';
    protected $fillable = [
        'first_name',
        'last_name',
        'dob',
        'position',
        'email',
        'password',
        'phone',
        'status',
        'restaurant_name',
        'restaurant_name_ar',
        'verification_code',
        'last_login',
        'address',
        'force_logout',
        'default_lang',
        'loyalty_points',
        'cashback',
        'email_verified_at'
    ];
    public const STORAGE = "user_files";
    public const STATUS_REJECTED = "rejected";
    public const STATUS_BLOCKED = "blocked";
    public const STATUS_ACTIVE = "active";
    public const STATUS_INACTIVE = "inactive";
    public const RESTAURANT_ROLE = "Restaurant Owner";
    const RE_UPLOAD_FILES = 're_upload_files';
    public const STATUSES = [
        self::STATUS_BLOCKED,
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
        self::STATUS_REJECTED
    ];

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
    ];
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function isDriver()
    {
        return $this->hasRole("Driver");
    }
    public function isWorker()
    {
        return $this->hasRole("Worker");
    }
    public function isAdmin()
    {
        return $this->hasRole("Administrator");
    }
    public function isRestaurantOwner()
    {
        return $this->hasRole("Restaurant Owner");
    }

    public function isBlocked()
    {
        return $this->status === self::STATUS_BLOCKED;
    }

    public function isRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function hasPermission($permission)
    {
        if($this->email==env('SUPER_MASTER_ADMIN_EMAIL'))return true;
        return DB::table('permissions')->where('user_id', $this->id)->value($permission) === 1;
    }

    public function traderRegistrationRequirement()
    {
        return $this->hasOne(TraderRequirement::class)->latest();
    }

    public function generateVerificationCode()
    {
        // TODO @todo create new email_verification_tokens record
        $this->verification_code = sprintf("%06d", mt_rand(1, 999999));
        $this->save();
    }
    public function updateLastLogin()
    {
        $this->last_login = now();
        $this->save();
    }

    public function checkVerificationCode($code)
    {
        return $this->verification_code === $code;
    }
    public function restaurant()
    {
        return $this->hasOne(Tenant::class);
    }
    public function requested_advertisements()
    {
        return $this->hasMany(AdsRequest::class);
    }

    /* Scopes */
    public function scopeRestaurantOwners($query)
    {
        return $query->whereHas('roles', function ($q) {
            return $q->where("name", "Restaurant Owner");
        });
    }
    public function scopeWhenType($query, $type)
    {
        return $query->when($type != null, function ($q) use ($type) {
            if ($type == 'complete_step_1') {
                return $q->whereDoesntHave('restaurant');
            } elseif ($type == 'complete_step_2') {
                return $q->whereHas('restaurant');
            } elseif ($type == 'have_active_restaurant') {
                return $q->whereHas('restaurant', function ($subQ) {
                    return $subQ->whereHas('central_tenant_setting', function ($subQ2) {
                        return $subQ2->where('is_live', 1);
                    });
                });
            } elseif ($type == 'have_inactive_restaurant') {
                return $q->whereHas('restaurant', function ($subQ) {
                    return $subQ->whereHas('central_tenant_setting', function ($subQ2) {
                        return $subQ2->where('is_live', 0);
                    });
                });
            } elseif ($type == 'verified_email') {
                return $q->where('email_verified_at', '!=', null);
            } elseif ($type == 'not_verified_email') {
                return $q->where('email_verified_at', null);
            }
        });
    }
    public function scopeWhenSearch($query,$search)
    {
        return $query->when($search != null, function ($q) use ($search) {
            return $q->where('first_name', 'like', '%' . $search . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%')
            ->orWhere('restaurant_name', 'like', '%' . $search . '%')
            ->orWhere('restaurant_name_ar', 'like', '%' . $search . '%');
        });
    }
    /* Scopes */
    protected static function newFactory()
    {
      return UserFactory::new();
    }
}
