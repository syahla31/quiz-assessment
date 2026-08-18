<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Quiz;
use App\Services\QuizService;
use Illuminate\Support\Facades\Auth;

class TakeQuiz extends Component
{
    public Quiz $quiz;
    public array $answers = []; // Format: [question_id => option_id]

    public function mount($quizId)
    {
        $this->quiz = Quiz::with(['questions.options'])->findOrFail($quizId);
    }

    public function submit(QuizService $quizService)
    {
        // Validasi: pastikan semua soal dijawab
        $this->validate([
            'answers' => 'required|array|min:' . $this->quiz->questions->count(),
        ], [
            'answers.min' => 'Harap jawab semua pertanyaan yang ada.',
        ]);

        // Simpan via QuizService
        $submission = $quizService->submitQuiz(
            $this->quiz->id,
            Auth::id(),
            $this->answers
        );

        // Redirect ke halaman hasil
        return redirect()->route('quiz.result', $submission->id);
    }

    public function render()
    {
        return view('livewire.public.take-quiz');
    }
}