<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{

    public function index()
    {
        $student = auth()->user()->student;
        $courses = $student->courses;
        $exams = Exam::whereIn('course_id', $courses->pluck('id'))->latest()->paginate(4);
        return view('student.exams', compact('exams'));
    }

    public function showExamInfo(string $id)
    {
       $exam = Exam::findOrFail($id);
       return view('student.exam-info',compact('exam'));
    }
    public function showExam(string $id)
    {
        $exam = Exam::findOrFail($id);
        $questions =  Question::where('exam_id', $exam->id)->latest()->paginate(4);
        return view('student.exam', compact('exam', 'questions'));
    }

}
