<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamStatus;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultAndStatusController extends Controller
{
    public function ShowExams()
    {
        $teacher = auth()->user()->teacher;
        $courses = $teacher->courses;
        $exams = Exam::whereIn('course_id', $courses->pluck('id'))->latest()->paginate(3);

        return view('teacher.results', compact('exams'));
    }


    public function showExamResults(string $id)
    {
        $exam = Exam::findOrFail($id);
        $results = Result::where('exam_id', $exam->id)->latest()->paginate(5);

        return view('teacher.show-result', compact('exam', 'results'));
    }

    public function showExamStatuses()
    {
        $teacher = auth()->user()->teacher;
        $courses = $teacher->courses;
        $exams = Exam::whereIn('course_id', $courses->pluck('id'))->latest()->paginate(3);

        return view('teacher.statuses', compact('exams'));
    }

    public function showExamStatus(string $id)
    {
        $exam = Exam::findOrFail($id);
        $statuses = ExamStatus::where('exam_id', $exam->id)->latest()->paginate(5);

        return view('teacher.show-status', compact('exam', 'statuses'));
    }
}
