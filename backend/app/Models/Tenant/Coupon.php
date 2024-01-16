<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';

    protected $casts = [
        'active_from' => 'date',
        'expire_at' => 'date',
    ];
    protected $guarded = [];
    /* Methods */
    public function toggleStatus()
    {
        $this->status = !$this->status;
        $this->save();
    }
}
