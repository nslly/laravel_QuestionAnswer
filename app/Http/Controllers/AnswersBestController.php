<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class AnswersBestController extends Controller
{
    public function __invoke(Answer $answer)
    {

        if(request()->expectsJson()) {
            return response()->json([
                'message'   => "You have accepted this answer as best answer",
                'save'      => $answer->question->acceptBestAnswer($answer)
            ]);
        }
        if (Gate::allows('accept-best-answer', $answer)) {
            $answer->question->acceptBestAnswer($answer);
            
            return back();
        } else {
            abort(403);
        }
        
    }
}
