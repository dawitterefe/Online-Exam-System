<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
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

}
