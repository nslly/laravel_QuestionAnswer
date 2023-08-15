<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class AnswersBestController extends Controller
{
    public function __invoke(Answer $answer)
    {

        
        if (Gate::allows('accept-best-answer', $answer)) {
            $acceptBest = $answer->question->acceptBestAnswer($answer);
            if(request()->expectsJson()) {
                return response()->json([
                    'message'   => "You have accepted this answer as best answer",
                    'save'      => $acceptBest
                ]);
            }
            return back();
        } else {
            abort(403);
        }
    }
}
