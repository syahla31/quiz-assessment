<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Services\QuizService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QuizPdfController extends Controller
{
    public function downloadPdf($submissionId, QuizService $quizService)
    {
        $submission = Submission::with(['quiz', 'answers.question', 'answers.option'])->findOrFail($submissionId);
        $category = $quizService->getCategory($submission->score);

        $pdf = Pdf::loadView('pdf.quiz-result', compact('submission', 'category'));
        
        return $pdf->download('Hasil_Asesmen_' . $submission->id . '.pdf');
    }
}