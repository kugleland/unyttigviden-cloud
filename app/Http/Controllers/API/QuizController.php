<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuizQuestion;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        return QuizResource::collection(Quiz::paginate(20));
    }

    public function show(Quiz $quiz)
    {
        #$quiz->load('questions');
        return QuizResource::make($quiz);
    }



    public function generateQuiz()
    {
        $questions = Question::inRandomOrder()->limit(2)->get();

        // Create a quiz instance
        $quiz = Quiz::create([
            'title' => 'Quiz 2',
            'description' => 'Quiz 2 description',
            'user_id' => 1,
            'total_questions' => count($questions),
            'status' => 'not_started',
        ]);

        // Attach questions to quiz
        foreach ($questions as $question) {
            QuizQuestion::create([
                'quiz_id' => $quiz->id,
                'question_id' => $question->id,
            ]);
        }


        return response()->json(['quiz_id' => $quiz->id, 'questions' => $questions]);
        // $quiz = Quiz::create([
        //     'title' => 'Quiz 1',
        //     'description' => 'Quiz 1 description',
        // ]);
    }


    public function generateQuizQuestions()
    {
        $questions = [
            [
                'question_text' => 'What is the capital of France?',
                'options' => ['Paris', 'London', 'Berlin', 'Madrid'],
                'correct_answer' => 'Paris',
                'difficulty_level' => 1,
                'type' => 'multiple_choice',
                'category_id' => 9,
            ],
            [
                'question_text' => 'What is the top speed of a cheetah?',
                'options' => ['100 km/h', '120 km/h', '140 km/h', '160 km/h'],
                'correct_answer' => '140 km/h',
                'difficulty_level' => 1,
                'type' => 'multiple_choice',
                'category_id' => 5,
            ],
            [
                'question_text' => 'Copenhagen is the capital of Denmark',
                'options' => ['True', 'False'],
                'correct_answer' => 'True',
                'difficulty_level' => 1,
                'type' => 'true_false',
                'category_id' => 9,
            ],
            [
                'question_text' => 'The Eiffel Tower is placed in _____',
                'options' => ['Paris', 'London', 'Berlin', 'Madrid'],
                'correct_answer' => 'Paris',
                'difficulty_level' => 1,
                'type' => 'fill_in_the_blank',
                'category_id' => 9,
            ]
        ];


        foreach ($questions as $question) {
            Question::create($question);
        }

        return $questions;
    }
}
