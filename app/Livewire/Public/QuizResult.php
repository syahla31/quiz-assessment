<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Submission;
use App\Services\QuizService;

class QuizResult extends Component
{
    public Submission $submission;
    public string $category = '';

    public function mount($submissionId, QuizService $quizService)
    {
        $this->submission = Submission::with(['quiz', 'answers.question', 'answers.option'])->findOrFail($submissionId);
        
        // Mengambil kategori berdasarkan skor
        $this->category = $quizService->getCategory($this->submission->score);
    }

    public function render()
    {
        return view('components.public.quiz-result');
    }
}