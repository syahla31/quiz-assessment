<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quiz = Quiz::create([
            'title' => 'Tes Kepribadian MBTI (16 Personalities)',
            'description' => 'Asesmen singkat untuk mengukur kecenderungan preferensi kepribadian berdasarkan 4 dikotomi utama.',
        ]);

        $questions = [
            ['text' => 'Saya merasa kembali berenergi setelah menghabiskan waktu berinteraksi dengan banyak orang.', 'dimension' => 'E_vs_I'],
            ['text' => 'Saya lebih suka mengutarakan ide secara langsung melalui percakapan daripada menuliskannya.', 'dimension' => 'E_vs_I'],
            ['text' => 'Saya mudah memulai percakapan dengan orang yang baru pertama kali saya temui.', 'dimension' => 'E_vs_I'],
            
            ['text' => 'Saya lebih tertarik membahas gagasan ide masa depan daripada fakta praktis saat ini.', 'dimension' => 'S_vs_N'],
            ['text' => 'Saya sering mengandalkan intuisi atau gambaran besar daripada memperhatikan detail fakta.', 'dimension' => 'S_vs_N'],
            ['text' => 'Saya menyukai tugas yang membutuhkan kreativitas daripada mengikuti metode standar.', 'dimension' => 'S_vs_N'],
            
            ['text' => 'Dalam mengambil keputusan, saya lebih mengutamakan perasaan dan dampaknya terhadap orang lain.', 'dimension' => 'T_vs_F'],
            ['text' => 'Saya merasa mudah berempati dan cenderung menghindari konflik langsung.', 'dimension' => 'T_vs_F'],
            ['text' => 'Saya lebih tergerak oleh nilai-nilai kemanusiaan daripada keadilan rasional yang kaku.', 'dimension' => 'T_vs_F'],
            
            ['text' => 'Saya lebih nyaman bekerja secara fleksibel dan spontan dibanding mengikuti jadwal ketat.', 'dimension' => 'J_vs_P'],
            ['text' => 'Saya cenderung menyelesaikan pekerjaan menjelang tenggat waktu untuk menjaga pilihan tetap terbuka.', 'dimension' => 'J_vs_P'],
            ['text' => 'Saya tidak masalah jika rencana yang sudah disusun mendadak berubah di tengah jalan.', 'dimension' => 'J_vs_P'],
        ];

        $options = [
            ['text' => 'Sangat Tidak Sesuai', 'score' => 0],
            ['text' => 'Tidak Sesuai', 'score' => 1],
            ['text' => 'Sesuai', 'score' => 2],
            ['text' => 'Sangat Sesuai', 'score' => 3],
        ];

        foreach ($questions as $q) {
            $question = $quiz->questions()->create([
                'question_text' => $q['text'],
            ]);

            foreach ($options as $opt) {
                $question->options()->create([
                    'option_text' => $opt['text'],
                    'score' => $opt['score'],
                ]);
            }
        }
    }
}
