<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Quiz;

class QuizList extends Component
{
    public function render()
    {
        $quizzes = Quiz::withCount('questions')
            ->latest()
            ->get();

        // Mengarahkan ke file resources/views/components/public/quiz-list.blade.php
        return view('public.quiz-list', compact('quizzes'));
    }
}