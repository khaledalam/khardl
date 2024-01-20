<?php

namespace App\Models\Tenant;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Enums\Admin\CouponTypes;

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
    public function getValidityAttribute()
    {
        $condition = $this->status == 1
            && now()->startOfDay() >= $this->active_from
            && $this->expire_at >= now()->startOfDay();
        if (!$condition)
            return $condition;
        else {
            if ($this->max_use) {
                return $this->users()->count() < $this->max_use;
            }
        }
        return $condition;
    }
    public function getUserValidityAttribute()
    {
        if ($this->max_use_per_user) {
            return $this->users()->where('user_id', Auth::user()->id)->get()->count() < $this->max_use_per_user;
        }
        return true;
    }
    public function calculateDiscount($total)
    {
        $discount = $total;
        if ($this->type == CouponTypes::FIXED_COUPON->value) {
            $discount = $this->amount;
        } elseif ($this->type == CouponTypes::PERCENTAGE_COUPON->value) {
            $discount = ($this->amount * $total) / 100;
        }
        if ($this->max_discount_amount && $discount > $this->max_discount_amount) {
            $discount = $this->max_discount_amount;
        }
        return $discount;
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_coupons');
    }
}
