<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamStatus;
use App\Models\Question;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
        return view('student.exam-info', compact('exam'));
    }
    public function showExam(string $id)
    {
        $exam = Exam::findOrFail($id);
        $student_id = auth::user()->student->id;
        $questions = Question::where('exam_id', $exam->id)->inRandomOrder()->get();


        if (Result::where('student_id', $student_id)->where('exam_id', $exam->id)->exists()) {

            return Redirect::route('student.exams', compact('exam', 'questions'))->with('status', 'already_taken');
        } else {

            if (ExamStatus::where('student_id', $student_id)->where('exam_id', $exam->id)->doesntExist()) {

                ExamStatus::create([
                    'exam_id' => $exam->id,
                    'student_id' => $student_id,
                    'started_at' => now(),
                ]);
                $duration = $exam->duration;
                return view('student.exam', compact('exam', 'questions','duration'));
            } else {
                $duration = ExamStatus::where('student_id', $student_id)->where('exam_id', $exam->id)->value('remaining_time');
                return view('student.exam', compact('exam', 'questions','duration'));
            }
        }
    }

    public function sendRemainingTime(string $remaining_time, string $exam_id)
    {
        ExamStatus::where('student_id', auth::user()->student->id)->where('exam_id', $exam_id)->update([
            'remaining_time' => $remaining_time
        ]);
        return 'working in the shadow';
    }

    public function submitExam(Request $request, string $id)
    {
        $exam = Exam::findOrFail($id);
        $questions = $exam->questions;
        $total_Questions = $exam->total_questions;
        $score = 0;


        foreach ($questions as $question) {
            $answer = $request->input($question->id);
            if ($answer == $question->answer) {
                $score = $score + $question->points;
            }
        }

        $result = new Result();
        $result->exam_id = $exam->id;
        $result->student_id = Auth::user()->student->id;
        $result->score = $score;

        if ($score >= $exam->passing_score) {
            $result->passed = true;
        } else  $result->passed = false;

        $result->save();

        ExamStatus::where('student_id', auth::user()->student->id)->where('exam_id', $exam->id)->update([
            'finished_at' => now()
        ]);



        $student = auth()->user()->student;
        $results = Result::where('student_id', $student->id)->latest()->paginate(3);

        if ($score >= $exam->passing_score) {
            return Redirect::route('student.exam-results', compact('results'))->with('status', 'passed');
        } else return Redirect::route('student.exam-results', compact('results'))->with('status', 'failed');
    }

    public function ShowResults()
    {
        $student = auth()->user()->student;
        $results = Result::where('student_id', $student->id)->latest()->paginate(3);
        return view('student.results', compact('results'));
    }
}
