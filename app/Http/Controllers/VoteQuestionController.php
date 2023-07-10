<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request,Question $question)
    {
        $vote = $request->input('vote');

        $request->user()->voteQuestion($question, $vote);

        return back();
    }
}
