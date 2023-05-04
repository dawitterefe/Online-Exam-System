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

        $exam = $request->input('exam_id');
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

        // retrieving the Exam object using the $exam_id variable before passing it to the redirect method
        $exam_id = Exam::findOrFail($exam);

        return redirect()->route('exams.show', $exam_id->id);
    }

    public function edit(string $question_id, string $exam_id)
    {
        $question = Question::findOrFail($question_id);
        $exam = Exam::findOrFail($exam_id);
        return view("teacher.edit-question", compact('question', 'exam'));
    }

    public function update(Request $request, string $id)
    {
        $question = Question::findOrfail($id);
        $exam = $request->input('exam_id');

        $request->validate([
            'exam_id' => 'integer',
            'question' => 'max:500',
            'option_1' => '',
            'option_2' => '',
            'option_3' => 'nullable',
            'option_4' => 'nullable',
            'answer' => '',
            'points' => 'integer',
        ]);

        $question->exam_id = $request->exam_id;
        $question->question = $request->question;
        $question->option_1 = $request->option_1;
        $question->option_2 = $request->option_2;
        $question->option_3 = $request->option_3;
        $question->option_4 = $request->option_4;
        $question->answer = $request->answer;
        $question->points = $request->points;
        $question->save();

        $exam_id = Exam::findOrFail($exam);

        return redirect()->route('exams.show', $exam_id->id);

    }


    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        
        return redirect()->back();
    }
}
