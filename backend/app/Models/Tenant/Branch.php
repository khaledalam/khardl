<?php

namespace App\Models\Tenant;

use App\Models\Tenant\PaymentMethod;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    // use HasTranslations;
    // TODO @todo soft deletes
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
        'delivery_availability',
        'pickup_availability',
        'preparation_time_delivery'
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



}
