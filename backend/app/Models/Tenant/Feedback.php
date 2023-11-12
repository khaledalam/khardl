<?php

namespace App\Models\Tenant;

use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'rating',
        'type',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }
}
