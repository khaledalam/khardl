<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promoter extends Model
{
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
}
