<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusLogs extends Model
{
    protected $table = 'order_status_logs';

    protected $fillable = [
        'order_id',
        'status',
        'notes',
        'class_name'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
