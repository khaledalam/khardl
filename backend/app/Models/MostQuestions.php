<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MostQuestions extends Model
{
    use HasTranslations;

    protected $table = 'most_questions';

    public $translatable = ['question', 'answer'];

    protected $fillable = [
        'question',
        'answer'
    ];
}
