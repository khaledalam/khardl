<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['user_id', 'action', 'timestamp'];
    public $timestamps = true;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
