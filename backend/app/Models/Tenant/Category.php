<?php

namespace App\Models\Tenant;

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
        'user_id'
    ];

    public $translatable = ['name'];
   
   
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
        return $this->hasMany(Item::class)->where('availability', true);
    }
}
