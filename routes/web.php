<?php

use App\Http\Controllers\QuizPdfController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Public\QuizList;
use App\Livewire\Public\TakeQuiz;
use App\Livewire\Public\QuizResult;
use App\Livewire\Admin\QuizManager;
use App\Livewire\Admin\QuestionManager;


// 1. Publik (Bisa diakses siapa saja tanpa login)
Route::get('/', QuizList::class)->name('home');
Route::get('/quiz/{quizId}', TakeQuiz::class)->name('quiz.take');
Route::get('/quiz/result/{submissionId}', QuizResult::class)->name('quiz.result');
Route::get('/quiz/result/{submissionId}/pdf', [QuizPdfController::class, 'downloadPdf'])->name('quiz.pdf.download');

// 2. Khusus Admin CMS (Wajib Login)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/quizzes', QuizManager::class)->name('quizzes.index');
    Route::get('/quizzes/{quizId}/questions', QuestionManager::class)->name('quizzes.questions');
});