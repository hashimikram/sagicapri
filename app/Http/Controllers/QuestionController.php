<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Questions;
use App\Models\Answers;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'quiz_title' => 'required',
            'questions' => 'required|array',
            'questions.*.question_text' => 'required',
            'questions.*.answers' => 'required|array',
            'questions.*.answers.*.answer_text' => 'required',
            'questions.*.answers.*.is_correct' => 'required|boolean',
        ]);

        $quiz = new Quiz([
            'title' => $validatedData['quiz_title'],
        ]);
       $quiz->save();

        foreach ($validatedData['questions'] as $questionData) {
            $question = new Questions([
                'question_text' => $questionData['question_text'],
                'quiz_id' => $quiz->id,
            ]);
            $question->save();

            foreach ($questionData['answers'] as $answerData) {
                $answer = new Answers([
                    'answer_text' => $answerData['answer_text'],
                    'is_correct' => $answerData['is_correct'],
                    'questions_id' => $question->id,
                ]);
                $answer->save();
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $quiz->load('questions.answers')
        ]);
    }
}
