<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(User::class);
    }
}
