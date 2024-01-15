<?php

namespace App\Models;

use App\Jobs\SendVerifyEmailJob;
use App\Mail\verifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Str;
use App\Models\TraderRequirement;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use MustVerifyEmailTrait, HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table ='users';
    protected $primaryKey = 'id';
    protected $guard_name = 'web';
    protected $fillable = [
        'first_name',
        'last_name',
        'position',
        'email',
        'password',
        'phone',
        'status',
        'restaurant_name',
        'verification_code',
        'last_login',
        'address'
    ];
    public const STORAGE = "user_files";
    public const STATUS_BLOCKED = "blocked";
    public const STATUS_ACTIVE = "active";

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

    public function isAdmin(){
        return $this->hasRole("Administrator");
    }
    public function isRestaurantOwner(){
        return $this->hasRole("Restaurant Owner");
    }

    public function isBlocked(){
        return $this->status === self::STATUS_BLOCKED;
    }

    public function isActive(){
        return $this->status === self::STATUS_ACTIVE;
    }
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function hasPermission($permission)
    {
        return DB::table('permissions')->where('user_id', $this->id)->value($permission) === 1;
    }



    public function traderRegistrationRequirement()
    {
        return $this->hasOne(TraderRequirement::class);
    }
    public function generateVerificationCode()
    {
        // TODO @todo create new email_verification_tokens record
        $this->verification_code = Str::random(6);
        $this->save();
    }

    public function checkVerificationCode($code)
    {
        return $this->verification_code === $code;
    }
    public function restaurant(){
        return $this->hasOne(Tenant::class);
    }


    public function sendEmailVerificationNotification()
    {
        die("here");
        //dispactches the job to the queue passing it this User object
        verifyEmail::dispatch($this);
    }
    /* Scopes */
    public function scopeRestaurantOwners($query)
    {
        return $query->whereHas('roles',function($q){
            return $q->where("name","Restaurant Owner");
        });
    }
    public function scopeWhenType($query,$type)
    {
        return $query->when($type != null, function ($q) use ($type) {
            if($type=='complete_step_1'){
                return $q->whereDoesntHave('restaurant');
            }elseif($type=='complete_step_2'){
                return $q->whereHas('restaurant');
            }elseif($type=='have_active_restaurant'){
                /* TODO:Synced resources */
            }elseif($type=='have_inactive_restaurant'){
                /* TODO:Synced resources */
            }elseif($type=='verified_email'){
                return $q->where('email_verified_at','!=',null);
            }elseif($type=='not_verified_email'){
                return $q->where('email_verified_at',null);
            }
        });
    }
    /* Scopes */

}
