<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id'];

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    
    public static function boot(): void
    {
        parent::boot();

        static::created(function ($answer) {
            $answer->question->increment('answers');
        });

        static::deleted(function ($answer) {
            $answer->question->decrement('answers');
        });
    }
}
