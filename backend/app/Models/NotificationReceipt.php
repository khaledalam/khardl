<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationReceipt extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'name',
        'active',
        'is_branch_purchase',
        'is_application_purchase',
        'is_ads_requests'
    ];
    /* Scopes */
    const is_branch_purchase = "is_branch_purchase";
    const is_application_purchase = "is_application_purchase";
    const is_lifetime_purchase = "is_lifetime_purchase";
    public function scopeWhenSearch($query,$search)
    {
        return $query->when($search != null, function ($q) use ($search) {
            return $q->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
        });
    }
    public function scopeWhenStatus($query,$status)
    {
        return $query->when($status != null, function ($q) use ($status) {
            if($status == 'true'){
                return $q->where('active', 1);
            }else{
                return $q->where('active', 0);
            }
        });
    }
    public function toggleActive():void
    {
        $this->active = !$this->active;
        $this->save();
    }
}
