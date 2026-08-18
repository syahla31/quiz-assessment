<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Public\QuizList;
use App\Livewire\Public\TakeQuiz;
use App\Livewire\Public\QuizResult;
use App\Livewire\Admin\QuizManager;
use App\Livewire\Admin\QuestionManager;

// 1. Halaman Depan / Landing Page
Route::get('/', function () {
    return view('welcome');
});

// 2. Halaman User setelah Login (Kuis & Hasil)
Route::middleware(['auth'])->group(function () {
    // Dashboard / Home User
    // Route::get('/home', QuizList::class)->name('home'); 

    // Pengerjaan & Hasil Kuis
    Route::get('/quiz/{quizId}', TakeQuiz::class)->name('quiz.take');
    Route::get('/quiz/result/{submissionId}', QuizResult::class)->name('quiz.result');
});

// 3. Halaman Admin CMS (Manajemen Kuis & Soal)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Manajemen Daftar Kuis
    // Route::get('/quizzes', QuizManager::class)->name('quizzes.index');
    
    // Kelola Soal & Opsi untuk Kuis tertentu
    // Route::get('/quizzes/{quizId}/questions', QuestionManager::class)->name('quizzes.questions');
});