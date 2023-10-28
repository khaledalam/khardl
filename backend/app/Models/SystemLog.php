<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $table = 'system_logs';

    protected $fillable = [
        'user_id',
        'log_type',
        'message',
        'context',
        'url',
        'ip_address',
        'user_agent'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
