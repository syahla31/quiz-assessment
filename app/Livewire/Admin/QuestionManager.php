<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Support\Facades\DB;

class QuestionManager extends Component
{
    public Quiz $quiz;
    public $questionText;
    public $questionId;
    public $options = [
        ['option_text' => '', 'score' => 0],
        ['option_text' => '', 'score' => 1],
        ['option_text' => '', 'score' => 2],
        ['option_text' => '', 'score' => 3],
    ];

    public bool $isModalOpen = false;

    public function mount($quizId)
    {
        $this->quiz = Quiz::with(['questions.options'])->findOrFail($quizId);
    }

    public function addOptionRow()
    {
        $this->options[] = ['option_text' => '', 'score' => 0];
    }

    public function removeOptionRow($index)
    {
        if (count($this->options) > 2) {
            unset($this->options[$index]);
            $this->options = array_values($this->options);
        }
    }

    public function openModal()
    {
        $this->resetModal();
        $this->isModalOpen = true;
    }

    public function editQuestion($id)
    {
        $question = Question::with('options')->findOrFail($id);
        $this->questionId = $question->id;
        $this->questionText = $question->question_text;
        
        $this->options = $question->options->map(function ($opt) {
            return [
                'option_text' => $opt->option_text,
                'score' => $opt->score,
            ];
        })->toArray();

        $this->isModalOpen = true;
    }

    public function saveQuestion()
    {
        $this->validate([
            'questionText' => 'required|string',
            'options.*.option_text' => 'required|string',
            'options.*.score' => 'required|numeric',
        ]);

        DB::transaction(function () {
            $question = Question::updateOrCreate(
                ['id' => $this->questionId],
                [
                    'quiz_id' => $this->quiz->id,
                    'question_text' => $this->questionText,
                ]
            );

            $question->options()->delete();

            foreach ($this->options as $opt) {
                $question->options()->create([
                    'option_text' => $opt['option_text'],
                    'score' => $opt['score'],
                ]);
            }
        });

        session()->flash('message', 'Pertanyaan & opsi berhasil disimpan.');
        $this->resetModal();
        $this->quiz->load('questions.options');
    }

    public function resetModal()
    {
        $this->questionId = null;
        $this->questionText = '';
        $this->options = [
            ['option_text' => '', 'score' => 0],
            ['option_text' => '', 'score' => 1],
            ['option_text' => '', 'score' => 2],
            ['option_text' => '', 'score' => 3],
        ];
        $this->isModalOpen = false;
    }

    public function deleteQuestion($id)
    {
        Question::findOrFail($id)->delete();
        $this->quiz->load('questions.options');
        session()->flash('message', 'Pertanyaan berhasil dihapus.');
    }

    public function render()
    {
        return view('components.admin.question-manager');
    }
}