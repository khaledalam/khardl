<?php

namespace App\Models\Tenant;

use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use MustVerifyEmailTrait, HasApiTokens, HasFactory, Notifiable,HasRoles;

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
        'verification_code',
        'last_login',
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

    
    public function hasPermission($permission)
    {
        return DB::table('permissions')->where('user_id', $this->id)->value($permission) === 1;
    }
    public function isRestaurantOwner(){
        return $this->hasRole("Restaurant Owner");
    }
    public function isWorker(){
        return $this->hasRole("Worker");
    }
    
    public function hasPermissionWorker($permission)
    {
        return DB::table('permissions_worker')->where('user_id', $this->id)->value($permission) === 1;
    }

   
}
