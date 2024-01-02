<?php

namespace App\Models\Tenant;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Item extends Model
{
    use HasTranslations;
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
        'availability'
    ];
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
    ];
    const STORAGE = "items";
    const STORAGE_SEEDER = "seeders/items";
    /* Start Relations */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
    /* End Scopes */

}

