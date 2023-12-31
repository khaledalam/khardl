<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentralSetting extends Model
{
    use HasFactory;

    protected $table = 'central_settings';

    protected $fillable = [
        'webhook_url',
        'live_chat_enabled'
    ];
}
