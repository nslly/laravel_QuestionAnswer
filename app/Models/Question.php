<?php

namespace App\Models;

use Parsedown;
use App\Models\User;
use App\Models\Answer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body'
    ];

    protected $appends = ['created_date', 'is_favorited', 'favorites_count'];


    public function user() {
        return $this->belongsTo(User::class);
    }

    // public function setTitleAttribute($value)
    // {
    //     $this->attributes['title'] = $value;
    //     $this->attributes['slug'] = Str::slug($value);
    
    // }

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => [
                'title' => $value,
                'slug'  => Str::slug($value)
            ]
        );
    }

    protected function createdDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->diffForHumans()
        );
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected function bodyHtmlAttribute(): Attribute
    {
        return Attribute::make(
            get: fn () =>  $this->bodyHtml()
        );
    }


    public function answers_for_questions() 
    {
        return $this->hasMany(Answer::class)->orderBy('votes_count', 'DESC');
    }

    public function acceptBestAnswer(Answer $answer) 
    {
        $answer->question->best_answer_id = $answer->id;
        $answer->question->save();
        return $this->best_answer_id;
    }

    public function favorites() 
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    protected function isFavorited(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->favorites()->where('user_id', Auth::id())->count() > 0
        );
    }

    protected function favoritesCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->favorites->count()
        );
    }

    public function votesUser(): MorphToMany
    {
        return $this->morphToMany(User::class, 'votable');
    }

    protected function excerpt(): Attribute
    {
        return Attribute::make(
            get: fn () =>  Str::limit(strip_tags($this->bodyHtml()), 300)
        );
    }


    protected function bodyHtml() 
    {
        return Parsedown::instance()->text($this->body);
    }

    

    

    // public function isfavorited() 
    // {
    //     return $this->favorites()->where('user_id', auth()->id)->count() > 0;
    // }



    // protected function url(): Attribute 
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => $value
    //     );
    // }


    // protected function createdDate(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => $this->created_at->diffForHumans($value)
    //     );
    // }

}
