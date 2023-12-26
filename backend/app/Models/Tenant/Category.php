<?php

namespace App\Models\Tenant;

use Carbon\Carbon;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    protected $table = 'categories';


    protected $fillable = [
        'name',
        'branch_id',
        'user_id',
        'photo'
    ];

    public $translatable = ['name'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    /**
     * Retrieve branch (if exists).
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    /**
     * Retrieve user (if exists).
     */
    public function user()
    {
        return $this->belongsTo(RestaurantUser::class);
    }
    public function items()
    {
        return $this->hasMany(Item::class); //->where('availability', true);
    }

}
