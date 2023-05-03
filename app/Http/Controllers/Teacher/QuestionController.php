<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function create(string $id)
    {
        $exam = Exam::findOrFail($id);
        return view('teacher.create-question', compact('exam'));
    }

    public function store(Request $request)
    {

        // $exam = $request->input('exam_id');
        // return $exam;
        
        $validatedData = $request->validate([
            'exam_id' => 'required|integer',
            'question' => 'required|max:500',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'nullable',
            'option_4' => 'nullable',
            'answer' => 'required',
            'points' => 'nullable|integer',
        ]);

        $question = Question::create($validatedData);

        return redirect()->route('exams.index');
    }
}
