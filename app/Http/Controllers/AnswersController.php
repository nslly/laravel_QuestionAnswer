<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AnswersController extends Controller
{

    public function __construct() 
    {
        return $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return $question->answers_for_questions()->with('user')->simplePaginate(2);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $validate = $request->validate([
            'body'      => 'required',
        ]);

        $validate['user_id'] = $request->user()->id;

        // dd($request->user()->id);
        $answer = $question->answers_for_questions()->create($validate);

        if(request()->expectsJson()) {
            return response()->json([
                'message'   => "Your answer is submitted successfully",
                'answer'    => $answer->load('user')
            ]);
        }
        

        return redirect(route('questions.show', $question->slug))->with('success', 'Your answer is submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        if (Gate::allows('update-answer', $answer)) {
            return view('answers.edit', [
                'answer'    => $answer,
                'question'  => $question
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $validate = $request->validate([
            'body'  => 'required'
        ]);

        $answer->update($validate);

        if(request()->expectsJson()) {
            return response()->json([
                'message'   => "Your answer is now updated",
                'body_html'      => $answer->body_html
            ]);
        }

        return redirect(route('questions.show', $question->slug))->with('success', "Your answer is now updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {

        
        if (Gate::allows('delete-answer', $answer)) {

            if(request()->expectsJson()) {
                return response()->json([
                    'message'   => "Your answer is deleted",
                    'delete'    => $answer->delete(),
                    
                ]);
            }
            
            return redirect(route('questions.show', $question->slug))->with('success', "Your answer is deleted");
        } else {
            abort(403);
        }
    }
}
