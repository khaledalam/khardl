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
        'live_chat_enabled',
        'auto_update_tap_sheet',
        'new_branch_slot_price', // @TODO used already in sub model
        'fee_flat_rate',  // @TODO not used for now
        'fee_percentage',  // @TODO not used for now
        'active_days_after_sub_expired'
    ];
}
