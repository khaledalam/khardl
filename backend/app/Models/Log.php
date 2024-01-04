<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Log extends Model
{
    use HasTranslations;
    public $translatable = ['action'];
    protected $fillable = ['user_id', 'action', 'timestamp','type','metadata'];
    public $timestamps = true;
    protected $casts = [
        'metadata' => 'json'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /* Scopes */
    public function scopeRecent($query)
    {
        return $query->orderBy('id','DESC');
    }
    public function scopeWhenUser($query,$search)
    {
        return $query->when($search != null, function ($q) use ($search) {
            return $q->where('user_id', $search);
        });
    }
    public function scopeWhenAction($query,$search)
    {
        return $query->when($search != null, function ($q) use ($search) {
            return $q->where('action', 'LIKE', '%' . $search . '%');
        });
    }
    /* TODO: getActionAttribute()
        For each test case return the final format
    */
}
