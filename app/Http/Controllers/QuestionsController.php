<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\AskQuestionRequest;
class QuestionsController extends Controller
{

    public function __construct() {
        return $this->middleware('auth')->except(['show', 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(2);



        return view('questions.index', [
            "questions" => $questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $questions = Question::all();


        return view('questions.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {

        $validated = $request->validated();
        

        $request->user()->questions()->create($validated);


        return redirect(route('questions.index'))->with('success', "The Questions are successfuly created.");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {

        $question->with('user')->increment('views');
        
        return view("questions.show", [
            'question' => $question
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {

        if (Gate::allows('update-question', $question)) {
            return view('questions.edit', [
                'question' => $question
            ]);
        } else {
            abort(403);
        }
        // Gate::allows('update-question', $question) ? Response::allow() : Response::denyWithStatus(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        $validated = $request->validated();
        $question->update($validated);

        return redirect(route('questions.index'))->with('success', 'Your question are now updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {

        if (Gate::allows('delete-question',$question)) {
            $question->delete();
            return redirect(route('questions.index'));
        } else {
            abort(403);
        }
        
    }
}
