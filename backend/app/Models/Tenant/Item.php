<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
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
    public $translatable = ['description'];
    const STORAGE = "items";
    const STORAGE_SEEDER = "seeders/items";
    

}
