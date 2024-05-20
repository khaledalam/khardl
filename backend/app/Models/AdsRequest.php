<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'price',
        'status',
        'advertisement_package_id',
        'answered_at'
    ];
    protected $casts = [
        'answered_at' => 'date'
    ];
    public function advertisement_package()
    {
        return $this->belongsTo(AdvertisementPackage::class)->withTrashed();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /* Scopes */
    public function scopeWhenSearch($query,$search)
    {
        return $query->when($search != null, function ($q) use ($search) {
            return $q->whereHas('user',function($subQ)use($search){
                return $subQ->where('first_name','LIKE','%' . $search . '%')
                ->orWhere('last_name','LIKE','%' . $search . '%')
                ->orWhere('email','LIKE','%' . $search . '%')
                ->orWhere('phone','LIKE','%' . $search . '%');
            })
            ->orWhereHas('advertisement_package',function($subQ)use($search){
                return $subQ->where('name','LIKE','%' . $search . '%');
            });
        });
    }
    public function scopeWhenStatus($query,$status)
    {
        return $query->when($status != null, function ($q) use ($status) {
            return $q->where('status', 'like',$status);
        });
    }
}
