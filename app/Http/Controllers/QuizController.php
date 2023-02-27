<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();

        return response()->json([
            'status' => 'success',
            'data' => $quizzes
        ]);
    }

    public function store(Request $request)
    {
        $quiz = Quiz::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $quiz
        ]);
    }

    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $quiz->load('questions.answers')
        ]);
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $quiz
        ]);
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return response()->json([
            'status' => 'success',
            'data' => null
        ]);
    }
}

