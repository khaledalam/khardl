<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerStyle extends Model
{
    protected $table = 'customer_styles';

    protected $fillable = [
        'user_id',
        'primary_color',
        'buttons_style',
        'images_style',
        'font_family',
        'font_type',
        'font_size',
        'font_alignment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
