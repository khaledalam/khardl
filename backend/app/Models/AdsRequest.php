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
        return $this->belongsTo(AdvertisementPackage::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
