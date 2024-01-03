<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['user_id', 'action', 'timestamp'];
    public $timestamps = true;
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
