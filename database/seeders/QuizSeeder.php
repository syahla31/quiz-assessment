<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quiz = Quiz::create([
            'title' => 'Asesmen Tingkat Stres & Kecemasan (DASS-21)',
            'description' => 'Tes singkat untuk mengukur tingkat kecemasan dan stres harian kamu.',
            'duration' => 10,
            'is_active' => true,
        ]);

        $questions = [
            'Saya merasa sulit untuk menenangkan diri.',
            'Saya merasa mulut saya kering.',
            'Saya tidak dapat merasakan perasaan positif sama sekali.',
            'Saya mengalami kesulitan bernapas (misal: napas cepat).',
        ];

        foreach ($questions as $index => $qText) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $qText,
                'question_type' => 'multiple_choice',
                'order' => $index + 1,
            ]);

            $options = [
                ['text' => 'Tidak Pernah', 'score' => 0],
                ['text' => 'Kadang-kadang', 'score' => 1],
                ['text' => 'Sering', 'score' => 2],
                ['text' => 'Sangat Sering', 'score' => 3],
            ];

            foreach ($options as $optIndex => $opt) {
                Option::create([
                    'question_id' => $question->id,
                    'option_text' => $opt['text'],
                    'score' => $opt['score'],
                    'order' => $optIndex + 1,
                ]);
            }
        }
    }
}
