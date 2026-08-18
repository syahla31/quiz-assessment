<?php

namespace App\Services;

use App\Models\Submission;
use App\Models\Answer;
use App\Models\Option;
use Illuminate\Support\Facades\DB;

class QuizService
{
    public function submitQuiz(int $quizId, ?int $userId, array $selectedOptions): Submission
    {
        return DB::transaction(function () use ($quizId, $userId, $selectedOptions) {
            $submission = Submission::create([
                'quiz_id'      => $quizId,
                'user_id'      => $userId,
                'score'        => 0,
                'started_at'   => now(),
                'submitted_at' => now(),
            ]);

            $totalScore = 0;

            foreach ($selectedOptions as $questionId => $optionId) {
                Answer::create([
                    'submission_id' => $submission->id,
                    'question_id'   => $questionId,
                    'option_id'     => $optionId,
                ]);

                $option = Option::find($optionId);
                if ($option) {
                    $totalScore += $option->score;
                }
            }

            $submission->update([
                'score' => $totalScore,
            ]);

            return $submission;
        });
    }

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

    /**
     * Dispatcher untuk mendapatkan interpretasi dinamis berdasarkan jenis asesmen
     */
    public function getResultInterpretation(Submission $submission): array
    {
        $quizType = strtolower($submission->quiz->type ?? 'scale');

        return match ($quizType) {
            'mbti'    => $this->interpretMBTI($submission),
            'disc'    => $this->interpretDISC($submission),
            'scale', 'stress', 'anxiety' => $this->interpretScaleAssessment($submission->score),
            default   => $this->interpretGeneral($submission->score),
        };
    }

    /**
     * Interpretasi Skala Skor Klinis (Stress / Anxiety / DASS-21)
     */
    private function interpretScaleAssessment(float $score): array
    {
        if ($score <= 7) {
            return [
                'level'          => 'Normal / Rendah',
                'badge_color'    => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                'description'    => 'Indikator stres/kecemasan berada dalam rentang normal dan stabil.',
                'recommendation' => 'Pertahankan rutinitas istirahat teratur dan kebiasaan mindfulness sehari-hari.',
            ];
        } elseif ($score <= 14) {
            return [
                'level'          => 'Tingkat Sedang',
                'badge_color'    => 'bg-amber-50 text-amber-700 border-amber-200',
                'description'    => 'Terdeteksi adanya gejala kelelahan mental atau beban stres moderat.',
                'recommendation' => 'Kurangi beban multitasking, atur waktu jeda istirahat, dan lakukan self-care.',
            ];
        } else {
            return [
                'level'          => 'Tingkat Tinggi (Perlu Evaluasi)',
                'badge_color'    => 'bg-rose-50 text-rose-700 border-rose-200',
                'description'    => 'Terdapat gejala stres/kecemasan signifikan yang membutuhkan penanganan lebih lanjut.',
                'recommendation' => 'Disarankan untuk berkonsultasi langsung dengan konselor atau psikolog profesional.',
            ];
        }
    }

    /**
     * Interpretasi Kepribadian (MBTI / Tipe Kategori)
     */
    private function interpretMBTI(Submission $submission): array
    {
        // Contoh logika penentuan MBTI atau tipe dominan
        return [
            'level'          => 'Tipe Kepribadian Analitis & Kolaboratif',
            'badge_color'    => 'bg-indigo-50 text-indigo-700 border-indigo-200',
            'description'    => 'Kecenderungan Anda menunjukkan orientasi yang kuat pada pemecahan masalah secara terstruktur dan kerja sama tim.',
            'recommendation' => 'Manfaatkan kekuatan komunikasi dan pemikiran kritis Anda dalam mengelola proyek atau dinamika tim.',
        ];
    }

    /**
     * Interpretasi Gaya Perilaku (DISC)
     */
    private function interpretDISC(Submission $submission): array
    {
        return [
            'level'          => 'Dominance & Steadiness (D/S)',
            'badge_color'    => 'bg-purple-50 text-purple-700 border-purple-200',
            'description'    => 'Anda memiliki dorongan hasil yang kuat dibarengi dengan komitmen tinggi terhadap stabilitas tim.',
            'recommendation' => 'Fokus pada delegasi tugas terencana untuk menjaga efisiensi kerja.',
        ];
    }

    /**
     * Fallback General Assessment
     */
    private function interpretGeneral(float $score): array
    {
        return [
            'level'          => 'Hasil Asesmen Selesai',
            'badge_color'    => 'bg-blue-50 text-blue-700 border-blue-200',
            'description'    => 'Total skor Anda adalah ' . $score . ' poin.',
            'recommendation' => 'Gunakan rekap hasil asesmen ini sebagai bahan evaluasi pengembangan diri.',
        ];
    }
}