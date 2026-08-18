<?php

namespace App\Services;

use App\Models\Submission;
use App\Models\Answer;
use App\Models\Option;
use Illuminate\Support\Facades\DB;

class QuizService
{
    /**
     * Menyimpan jawaban user dan menghitung total skor.
     */
    public function submitQuiz(int $quizId, int $userId, array $selectedOptions): Submission
    {
        return DB::transaction(function () use ($quizId, $userId, $selectedOptions) {
            // 1. Buat data Submission awal
            $submission = Submission::create([
                'quiz_id' => $quizId,
                'user_id' => $userId,
                'score' => 0,
                'started_at' => now(), // Atau disesuaikan dari session
                'submitted_at' => now(),
            ]);

            $totalScore = 0;

            // 2. Simpan setiap jawaban ke tabel answers dan akumulasi skor
            foreach ($selectedOptions as $questionId => $optionId) {
                Answer::create([
                    'submission_id' => $submission->id,
                    'question_id' => $questionId,
                    'option_id' => $optionId,
                ]);

                $option = Option::find($optionId);
                if ($option) {
                    $totalScore += $option->score;
                }
            }

            // 3. Update total skor di submission
            $submission->update([
                'score' => $totalScore,
            ]);

            return $submission;
        });
    }

    /**
     * Mendapatkan kategori hasil berdasarkan skor
     */
    public function getCategory(float $score): string
    {
        if ($score <= 3) {
            return 'Rendah / Normal';
        } elseif ($score <= 7) {
            return 'Sedang';
        } else {
            return 'Tinggi / Perlu Perhatian Khusus';
        }
    }
}