<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Asesmen - {{ $submission->quiz->title }}</title>
    <style>
        body { font-family: sans-serif; color: #333; line-height: 1.5; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #4F46E5; padding-bottom: 15px; }
        .header h1 { color: #4F46E5; margin: 0; font-size: 24px; }
        .score-box { background-color: #EEF2FF; border: 1px solid #C7D2FE; border-radius: 8px; text-align: center; padding: 20px; margin-bottom: 25px; }
        .score-val { font-size: 36px; font-weight: bold; color: #4338CA; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #E5E7EB; padding: 8px 12px; font-size: 12px; text-align: left; }
        th { background-color: #F9FAFB; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Hasil Asesmen Psikologi</h1>
        <p>{{ $submission->quiz->title }}</p>
    </div>

    <div class="score-box">
        <div style="font-size: 14px; text-transform: uppercase; color: #4F46E5;">Total Skor</div>
        <div class="score-val">{{ $submission->score }}</div>
        <div style="font-size: 16px; margin-top: 5px;">Kategori: <strong>{{ $category }}</strong></div>
        <div style="font-size: 12px; color: #6B7280; margin-top: 4px;">Tanggal Pengerjaan: {{ $submission->created_at->format('d M Y, H:i') }}</div>
    </div>

    <h3>Rincian Jawaban:</h3>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 65%;">Pertanyaan</th>
                <th style="width: 20%;">Pilihan Jawaban</th>
                <th style="width: 10%;">Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($submission->answers as $index => $answer)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $answer->question->question_text }}</td>
                    <td>{{ $answer->option->option_text }}</td>
                    <td>+{{ $answer->option->score }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>