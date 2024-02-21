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
}
