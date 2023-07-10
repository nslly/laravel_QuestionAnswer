<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\VoteAnswerController;
use App\Http\Controllers\AnswersBestController;
use App\Http\Controllers\VoteQuestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/questions', QuestionsController::class); 
// Route::get('/questions/{question:slug}', [QuestionsController::class, 'show'])->name('questions.show');

Route::resource('questions.answers', AnswersController::class)->except(['index', 'show', 'create']);

Route::post('/answers/{answer}/best_answer', AnswersBestController::class)->name('answers.accept');

Route::post('questions/{question}/vote', VoteQuestionController::class);
Route::post('/answers/{answer}/vote', VoteAnswerController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/questions/{question}/favorites', [FavoritesController::class, 'store'])->name('questions.favorites');
Route::delete('/questions/{question}/favorites', [FavoritesController::class, 'destroy'])->name('questions.unfavorites');

require __DIR__.'/auth.php';
