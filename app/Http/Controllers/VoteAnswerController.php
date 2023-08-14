<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class VoteAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request,Answer $answer)
    {
        $vote = $request->input('vote');

        $votesCount = $request->user()->voteAnswer($answer, $vote);
        
        if(request()->expectsJson()) {
            return response()->json([
                'message'       => "Thank you for the feedback",
                'votesCount'    => $votesCount
            ]);
        }

        return back();
    }
}
