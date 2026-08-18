<?php

namespace Tests\Feature;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\User;
use App\Services\QuizService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizAssessmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_user_can_access_quiz_catalog(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_quiz_service_calculates_correct_score_and_category(): void
    {
        $quiz = Quiz::create([
            'title' => 'Sample Test',
            'type' => 'scale',
        ]);

        $question = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Sample Question?',
        ]);

        $option = Option::create([
            'question_id' => $question->id,
            'option_text' => 'High Option',
            'score' => 3,
        ]);

        $service = new QuizService();
        $submission = $service->submitQuiz($quiz->id, null, [$question->id => $option->id]);

        $this->assertEquals(3, $submission->score);
        $this->assertEquals('Rendah / Normal', $service->getCategory($submission->score));
    }

    public function test_guest_cannot_access_admin_panel(): void
    {
        $response = $this->get('/admin/quizzes');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_admin_can_access_admin_panel(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/quizzes');
        $response->assertStatus(200);
    }
}