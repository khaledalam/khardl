<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use MustVerifyEmailTrait, HasApiTokens, HasFactory, Notifiable;

    protected $table ='users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'role',
        'first_name',
        'last_name',
        'branch_id',
        'restaurant_name',
        'phone_number',
        'email',
        'password',
        'email_verified_at',
        'phone_verified_at',
        'isApprovedCommercial',
        'commercial_registration_pdf',
        'signed_contract_delivery_company',
        'points',
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

    public function hasPermissionWorker($permission)
    {
        return DB::table('permissions_worker')->where('user_id', $this->id)->value($permission) === 1;
    }

   
}
