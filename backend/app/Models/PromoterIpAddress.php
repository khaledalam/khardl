<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoterIpAddress extends Model
{
   protected $table = "promoters_ip_addresses";
   protected $fillable = [
      'promoter_id',
      'ip_address',
      'registered'
   ];
   public $timestamps = false;
}
