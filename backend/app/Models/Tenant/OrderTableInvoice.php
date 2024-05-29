<?php

namespace App\Models\Tenant;

use Carbon\Carbon;
use App\Models\Tenant\Branch;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\JsonResponse;

class OrderTableInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'n_of_guests',
        'date_time',
        'environment',
        'user_id',
        'note',
        'new_user',
        'branch_id',
        'status'
    ];
  

    public function user(){
        return $this->belongsTo(RestaurantUser::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    
}
