<?php

namespace App\Models;

use Parsedown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id'];

    protected $appends = ['created_date', 'body_html', 'best_answer'];

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected function createdDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->diffForHumans()
        );
    }

    protected function bestAnswer(): Attribute
    {
        return Attribute::make(
            get:  fn () => $this->id === $this->question->best_answer_id
        );
    }

    protected function bodyHtml(): Attribute
    {

        return Attribute::make(
            get: fn () => Parsedown::instance()->text($this->body)
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

    public function votesUser(): MorphToMany
    {
        return $this->morphToMany(User::class, 'votable');
    }

}
