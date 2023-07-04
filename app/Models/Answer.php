<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected function bestAnswer(): Attribute
    {
        return Attribute::make(
            get:  fn ($value) => $this->id === $this->question->best_answer_id
        );
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
