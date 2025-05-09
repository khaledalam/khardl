<?php

namespace App\Models\Tenant;

use App\Models\User;
use Database\Factories\tenant\ItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Item extends Model
{
    use HasTranslations, HasFactory;
    protected $table = 'items';

    protected $fillable = [
        'category_id',
        'branch_id',
        'user_id',
        'photo',
        'price',
        'calories',
        'name',
        'description',
        'checkbox_required',
        'checkbox_input_titles',
        'checkbox_input_maximum_choices',
        'checkbox_input_names',
        'checkbox_input_prices',
        'selection_required',
        'selection_input_names',
        'selection_input_prices',
        'selection_input_titles',
        'dropdown_required',
        'dropdown_input_titles',
        'dropdown_input_names',
        'dropdown_input_prices',
        'availability',
        'allow_buy_with_loyalty_points',
        'price_using_loyalty_points',
       
    ];
    protected $appends = ['loyalty_point_ratio'];
 
    public $translatable = ['description','name'];
    protected $casts = [
        'checkbox_required' => 'array',
        'checkbox_input_titles' => 'array',
        'checkbox_input_maximum_choices' => 'array',
        'checkbox_input_names' => 'array',
        'checkbox_input_prices' => 'array',
        'selection_required' => 'array',
        'selection_input_names' => 'array',
        'selection_input_prices' => 'array',
        'selection_input_titles' => 'array',
        'dropdown_required' => 'array',
        'dropdown_input_titles' => 'array',
        'dropdown_input_names' => 'array',
        'dropdown_input_prices' => 'array'
    ];
    const STORAGE = "items";
    const STORAGE_SEEDER = "seeders/items";
    /* Start Relations */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
    public function orders()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function getTotalOrderedCount()
    {
        return $this->orders()
            ->sum('quantity');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function getPhotoAttribute()
    {
        if(!isset($this->attributes['photo']))return null;
        return getImageFromTenant($this->attributes['photo']);
    }
    public function getLoyaltyPointRatioAttribute()
    {
        if($this->allow_buy_with_loyalty_points){
            return ceil($this->price /  $this->price_using_loyalty_points );
        }
        return null;
    }
    /* End Relations */
    /* Start Scopes */
    public function scopeWhenSearch($query, $search)
    {
        //TODO: Why case sensitive is enabled ?
        return $query->when($search != null, function ($q) use ($search) {
            return $q->where('name', 'LIKE', '%'.$search.'%');
        });
    }
    public function scopeWhenBranch($query, $id)
    {
        return $query->when($id != null, function ($q) use ($id) {
            return $q->whereHas('branch',function($q)use ($id){
                return $q->where('id',$id);
            });
        });
    }
    public function scopeUnAvailable($query)
    {
        return $query->where('availability', 0);
    }
    public function scopeRecent($query)
    {
        return $query->orderBy('id','DESC');
    }
    public function toggleAvailability()
    {
        $this->availability = !$this->availability;
        $this->save();
    }
    protected static function newFactory()
    {
      return ItemFactory::new();
    }
    /* End Scopes */

}

