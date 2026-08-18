<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Quiz;
use Illuminate\Support\Str;

class QuizManager extends Component
{
    use WithPagination;

    public $title, $description, $quizId;
    public bool $isModalOpen = false;
    public bool $isEditMode = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ];

    public function openModal()
    {
        $this->resetInputFields();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
        $this->quizId = null;
        $this->isEditMode = false;
    }

    public function store()
    {
        $this->validate();

        Quiz::updateOrCreate(
            ['id' => $this->quizId],
            [
                'title' => $this->title,
                'slug' => Str::slug($this->title) . '-' . Str::random(4),
                'description' => $this->description,
            ]
        );

        session()->flash('message', $this->isEditMode ? 'Kuis berhasil diperbarui.' : 'Kuis berhasil ditambahkan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $this->quizId = $id;
        $this->title = $quiz->title;
        $this->description = $quiz->description;
        $this->isEditMode = true;
        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        Quiz::findOrFail($id)->delete();
        session()->flash('message', 'Kuis berhasil dihapus.');
    }

    public function render()
    {
        $quizzes = Quiz::withCount('questions')->latest()->paginate(10);
        return view('components.admin.quiz-manager', compact('quizzes'));
    }
}