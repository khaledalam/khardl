<?php

namespace App\Models\Tenant;

use Carbon\Carbon;
use App\Packages\Msegat;
use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
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
        if($this->isRestaurantOwner()) return true;
        return DB::table('permissions_worker')->where('user_id', $this->id)->value($permission) === 1;
    }
    public function isRestaurantOwner(){
        return $this->hasRole("Restaurant Owner");
    }
    public function isWorker(){
        return $this->hasRole("Worker");
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

    public function hasVerifiedPhone(): bool
    {
        return $this->phone_verified_at != null;
    }
    public function generateVerificationSMSCode(){
        DB::table('phone_verification_tokens')->updateOrInsert([
            'user_id'=>$this->id,
            'created_at'=>Carbon::today(),
        ],
        [
            'attempts'=>  DB::raw('attempts + 1'),
        ]);
        $response = Msegat::sendOTP(
            userSender: $this->email,
            number: $this->phone,
        ); 
        return ($response['http_code'] == ResponseHelper::HTTP_OK)?$response['response']['id']:false;
    }
    public function checkVerificationSMSCode(string $otp){
        $response = Msegat::verifyOTP(
            userSender: $this->email,
            otp: $otp,
            id: session()->get('otp.'.$this->id)
        );
        if($response['http_code'] == ResponseHelper::HTTP_OK){
            session()->remove('otp.'.$this->id);
            DB::table('phone_verification_tokens')->where('user_id',$this->id)->delete();
            return true;
        }
        return false;
    }

}
