<?php

namespace App\Models\Tenant;

use App\Models\Tenant\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderTableInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'n_of_guests',
        'date_time',
        'environment',
        'user_id',
        'note',
        'status'
    ];
    public function user(){
        return $this->belongsTo(RestaurantUser::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
