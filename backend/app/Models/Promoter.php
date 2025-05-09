<?php

namespace App\Models;

use Database\Factories\PromoterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promoter extends Model
{
    use HasFactory;
    protected $table = "promoters";
    protected $fillable = [
        'name',
        'url',
        'user_id'
    ];

    public function getEnteredAttribute()
    {
        return $this->users()->count();
    }

    public function getRegisteredAttribute()
    {
        return $this->users()->where('registered',true)->count();
    }
    public function users(){
        return $this->hasMany(PromoterIpAddress::class);
    }
    protected static function newFactory()
    {
      return PromoterFactory::new();
    }
    public function sub_coupons(){
        return $this->hasMany(ROSubscriptionCoupon::class);
    }
    public function scopeWhenSearch($query,$search)
    {
        return $query->when($search != null, function ($q) use ($search) {
            return $q->where('name', 'like', '%' . $search . '%');
        });
    }
}
