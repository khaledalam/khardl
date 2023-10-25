<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PaymentMethod extends Model
{
    use HasTranslations;

    protected $table = 'payment_methods';

    protected $fillable = [
        'name',
        'description',
        'icon',
        'is_active'
    ];

    public $translatable = ['name', 'description'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
