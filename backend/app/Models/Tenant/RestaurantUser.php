<?php

namespace App\Models\Tenant;

use Carbon\Carbon;
use App\Packages\Msegat;
use App\Models\Tenant\Branch;
use App\Utils\ResponseHelper;
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
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    protected $table ='users';
    protected $primaryKey = 'id';
    protected $guard_name = 'web';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'status',
        'phone_verified_at',
        'last_login',
        'address'
    ];
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
    ];
    public function hasPermission($permission)
    {
        if($this->isRestaurantOwner()) return true;
        return DB::table('permissions_worker')->where('user_id', $this->id)->value($permission) === 1;
    }
    public function isRestaurantOwner(){
        return $this->hasRole("Restaurant Owner");
    }
    public function isWorker(){
        return $this->hasRole("Worker");
    }
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class,'roles');
    // }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function hasPermissionWorker($permission)
    {
        if($this->isRestaurantOwner()) return true;
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

    public function generateVerificationSMSCode(){
        $this->newAttempt();
        $response = Msegat::sendOTP(
            number: $this->phone
        );
        logger($response);
        return ($response['http_code'] == ResponseHelper::HTTP_OK)?$response['message']['id']:false;
    }

    public function checkVerificationSMSCode(string $otp){
        $this->newAttempt();
        $response = Msegat::verifyOTP(
            otp: $otp,
            id: $this->msegat_id_verification
        );
        if($response['http_code'] == ResponseHelper::HTTP_OK){
            DB::table('phone_verification_tokens')->where('user_id',$this->id)->delete();
            $this->phone_verified_at = now();
            $this->status = 'active';
            $this->save();
            return true;
        }
        return false;
    }

    public function newAttempt(){
        DB::table('phone_verification_tokens')->updateOrInsert([
            'user_id'=>$this->id,
            'created_at'=>Carbon::today(),
        ],
        [
            'attempts'=>  DB::raw('attempts + 1'),
        ]);
    }

    public function number_of_available_branches(): int
    {
        // @TODO: logic based on how many services(slots) owner buy

        return 1;
    }

    public function tap_verified(): bool
    {
        return $this->tap_verified;
    }
}

