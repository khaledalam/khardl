<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'user_id',
        'reviewable_id',
        'reviewable_type',
        'rating',
        'comment'
    ];

    public function reviewable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
