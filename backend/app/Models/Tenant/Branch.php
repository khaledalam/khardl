<?php

namespace App\Models\Tenant;

use App\Models\Tenant\DeliveryType;
use App\Models\Tenant\PaymentMethod;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Database\Factories\tenant\BranchFactory;
use App\Packages\DeliveryCompanies\DeliveryCompanies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'branches';

    protected $fillable = [
        'name',
        'lat',
        'lng',
        'phone',
        'address',
        'is_primary',
        'monday_open',
        'monday_close',
        'monday_closed',
        'tuesday_open',
        'tuesday_close',
        'tuesday_closed',
        'wednesday_open',
        'wednesday_close',
        'wednesday_closed',
        'thursday_open',
        'thursday_close',
        'thursday_closed',
        'friday_open',
        'friday_close',
        'friday_closed',
        'saturday_open',
        'saturday_close',
        'saturday_closed',
        'sunday_open',
        'sunday_close',
        'sunday_closed',
        'preparation_time_delivery',
        'delivery_companies_option',
        'drivers_option',
        'pickup_availability',
        'active',
        'display_category_icon'
    ];


    // public $translatable = ['name'];
    public function workers(){
        return $this->hasMany(RestaurantUser::class);
    }
    public function drivers(){
        return $this->hasMany(RestaurantUser::class)->whereHas('roles', function ($query) {
            $query->where('name', 'Driver');
        });
    }
    public function categories(){
        return $this->hasMany(Category::class);
    }
    public function payment_methods(){
        return $this->belongsToMany(PaymentMethod::class,'branches_payment_methods');
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function delivery_types(){
        return $this->belongsToMany(DeliveryType::class,'branches_delivery_types');
    }
    /* Start Scope */
    public function scopeISWorker($query, $user)
    {
        return $query->when($user->isWorker(), function ($q)use($user) {
            $q->where('id', $user->branch->id);
        });
    }
    /* End Scope */
    /* Start attributes */
    public function getTotalRevenuesAttribute()
    {
        $total = $this->orders()?->completed()?->sum('total');
        return [
                'number_formatted' => getAmount((float)$total),
                'number' => $total
        ];
    }
    /* End attributes */

    protected static function newFactory()
    {
      return BranchFactory::new();
    }

    public function isClosed(): bool
    {
        $todayDay = strtolower(date("l"));
        $dayClosed = $todayDay . '_closed';
        $openingTodayTime = $todayDay . '_open';
        $closingTodayTime = $todayDay . '_close';

        return ($this->{$dayClosed}
                || Carbon::parse($this->{$openingTodayTime})->isFuture()
                || Carbon::parse($this->{$closingTodayTime})->isPast());
    }
    // public function getDeliveryAvailabilityAttribute(){
    //     $delivery= $this->delivery_types()->where('name',DeliveryType::DELIVERY)->count();
    //     if(!$delivery) return false;
    //     $hasActiveDrivers = RestaurantUser::activeDrivers()->get()->count();
    //     $hasDeliveryCompanies = DeliveryCompanies::all()->count();
    //     return $delivery  && ($hasDeliveryCompanies||$hasActiveDrivers);
    // }
    // public function getPickupAvailabilityAttribute(){
    //     return ( $this->delivery_types()->where('name',DeliveryType::PICKUP)->count())?true:false;
    // }

}
