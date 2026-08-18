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
        // 1. Asesmen Tingkat Stres & Kecemasan (DASS-21 Scale)
        $quizScale = Quiz::updateOrCreate(
            ['title' => 'Asesmen Tingkat Stres & Kecemasan (DASS-21)'],
            [
                'description' => 'Tes singkat untuk mengukur tingkat kecemasan, ketegangan emosional, dan stres harian kamu.',
                'duration'    => 10,
                'is_active'   => true,
                'type'        => 'scale',
            ]
        );

        $quizScale->questions()->delete();

        $scaleQuestions = [
            'Saya merasa sulit untuk menenangkan diri setelah mengalami situasi menegangkan.',
            'Saya merasa mulut saya sering terasa kering atau detak jantung meningkat tanpa alasan fisik.',
            'Saya merasa sulit untuk merasakan perasaan positif atau antusiasme sama sekali.',
            'Saya mengalami kesulitan bernapas atau merasa cemas saat menghadapi tekanan.',
        ];

        $scaleOptions = [
            ['text' => 'Tidak Pernah', 'score' => 0],
            ['text' => 'Kadang-kadang', 'score' => 1],
            ['text' => 'Sering', 'score' => 2],
            ['text' => 'Sangat Sering', 'score' => 3],
        ];

        foreach ($scaleQuestions as $qText) {
            $question = $quizScale->questions()->create([
                'question_text' => $qText,
            ]);

            foreach ($scaleOptions as $opt) {
                $question->options()->create([
                    'option_text' => $opt['text'],
                    'score'       => $opt['score'],
                ]);
            }
        }

        // 2. Tes Kepribadian MBTI
        $quizMBTI = Quiz::updateOrCreate(
            ['title' => 'Tes Kepribadian MBTI (16 Personalities)'],
            [
                'description' => 'Asesmen komprehensif untuk mengukur kecenderungan preferensi kepribadian berdasarkan 4 dimensi utama.',
                'duration'    => 15,
                'is_active'   => true,
                'type'        => 'mbti',
            ]
        );

        $quizMBTI->questions()->delete();

        $mbtiQuestions = [
            // E vs I
            'Saya merasa kembali berenergi setelah menghabiskan waktu berinteraksi dengan banyak orang.',
            'Saya lebih suka mengutarakan ide secara langsung melalui percakapan daripada menuliskannya.',
            'Saya mudah memulai percakapan dengan orang yang baru pertama kali saya temui.',
            // S vs N
            'Saya lebih tertarik membahas gagasan ide masa depan daripada fakta praktis saat ini.',
            'Saya sering mengandalkan intuisi atau gambaran besar daripada memperhatikan detail fakta.',
            'Saya menyukai tugas yang membutuhkan kreativitas daripada mengikuti metode standar.',
            // T vs F
            'Dalam mengambil keputusan, saya lebih mengutamakan perasaan dan dampaknya terhadap orang lain.',
            'Saya merasa mudah berempati dan cenderung menghindari konflik langsung.',
            'Saya lebih tergerak oleh nilai-nilai kemanusiaan daripada keadilan rasional yang kaku.',
            // J vs P
            'Saya lebih nyaman bekerja secara fleksibel dan spontan dibanding mengikuti jadwal ketat.',
            'Saya cenderung menyelesaikan pekerjaan menjelang tenggat waktu untuk menjaga pilihan tetap terbuka.',
            'Saya tidak masalah jika rencana yang sudah disusun mendadak berubah di tengah jalan.',
        ];

        $mbtiOptions = [
            ['text' => 'Sangat Tidak Sesuai', 'score' => 0],
            ['text' => 'Tidak Sesuai', 'score' => 1],
            ['text' => 'Sesuai', 'score' => 2],
            ['text' => 'Sangat Sesuai', 'score' => 3],
        ];

        foreach ($mbtiQuestions as $qText) {
            $question = $quizMBTI->questions()->create([
                'question_text' => $qText,
            ]);

            foreach ($mbtiOptions as $opt) {
                $question->options()->create([
                    'option_text' => $opt['text'],
                    'score'       => $opt['score'],
                ]);
            }
        }
    }
}