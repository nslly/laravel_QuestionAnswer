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

        return $this->_vote($this->voteQuestions(), $question, $vote, 'votes');

    }

    public function voteAnswer(Answer $answer, $vote)
    {

        return $this->_vote($this->voteAnswers(), $answer, $vote, 'votes_count');
        

    }

    private function _vote($relationship, $model, $vote, $vote_table_column) {

        if($relationship->where('votable_id', $model->id)->exists()) {
            $relationship->updateExistingPivot($model, ['vote' => $vote]);
        } else {
            $relationship->attach($model, ['vote' => $vote]);
        }

        $model->load('votesUser');
        $downVotes = (int) $model->votesUser()->wherePivot('vote', -1)->sum('vote');
        $upVotes = (int) $model->votesUser()->wherePivot('vote', 1)->sum('vote');
        $model->$vote_table_column = $upVotes + $downVotes;
        $model->save();

        if($vote_table_column == 'votes_count') {
            return $model->votes_count;
        } else {
            return $model->votes;

        }

    }
}
