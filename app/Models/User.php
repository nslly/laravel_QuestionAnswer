<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Answer;
use App\Models\Question;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function answers_for_questions() 
    {
        return $this->hasMany(Answer::class);
    }

    public function favorites() 
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
    }

    public function voteAnswers(): MorphToMany
    {
        return $this->morphedByMany(Answer::class, 'votable');
    }

    public function voteQuestions(): MorphToMany
    {
        return $this->morphedByMany(Question::class, 'votable');
    }

    public function voteQuestion(Question $question, $vote)
    {
        if($this->voteQuestions()->where('votable_id', $question->id)->exists()) {
            $this->voteQuestions()->updateExistingPivot($question, ['vote' => $vote]);
        } else {
            $this->voteQuestions()->attach($question, ['vote' => $vote]);
        }

        $question->load('votesUser');
        $downVotes = (int) $question->votesUser()->wherePivot('vote', -1)->sum('vote');
        $upVotes = (int) $question->votesUser()->wherePivot('vote', 1)->sum('vote');

        $question->votes = $upVotes + $downVotes;
        $question->save();

    }

    public function voteAnswer(Answer $answer, $vote)
    {
        if($this->voteAnswers()->where('votable_id', $answer->id)->exists()) {
            $this->voteAnswers()->updateExistingPivot($answer, ['vote' => $vote]);
        } else {
            $this->voteAnswers()->attach($answer, ['vote' => $vote]);
        }

        $answer->load('votesUser');
        $downVotes = (int) $answer->votesUser()->wherePivot('vote', -1)->sum('vote');
        $upVotes = (int) $answer->votesUser()->wherePivot('vote', 1)->sum('vote');

        $answer->votes_count = $upVotes + $downVotes;
        $answer->save();

    }
}
