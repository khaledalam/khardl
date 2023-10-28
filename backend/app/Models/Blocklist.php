<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blocklist extends Model
{
    protected $table = 'blocklists';

    protected $fillable = [
        'user_id',
        'ip_address',
        'reason',
        'blocked_until'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
