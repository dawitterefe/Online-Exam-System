<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::latest()->paginate(4);
        return view('teacher.exams', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teacherId = Auth::user()->teacher->id;
        $courses = Course::where('teacher_id', $teacherId)->get();
        return view('teacher.create-exam', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'course' => ['required', 'exists:courses,id'],
            'total_questions' => ['required', 'integer', 'min:1'],
            'passing_score' => ['required', 'integer', 'min:1'],
            'duration' => ['required', 'integer', 'min:1'],
            'start_time' => ['required', 'date_format:Y-m-d H:i'],
            'end_time' => ['required', 'date_format:Y-m-d H:i'],

        ]);

        $exam = Exam::create([
            'name' => $request['exam_name'],
            'description' => $request['description'],
            'course_id' => $request['course'],
            'created_by' => Auth::id(),
            'total_questions' => $request['total_questions'],
            'passing_score' => $request['passing_score'],
            'duration' => $request['duration'],
            'start_time' => $request['start_time'],
            'end_time' => $request['end_time'],

        ]);

        return redirect()->route('exams.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $exam = Exam::findOrFail($id);
        $questions =  Question::where('exam_id',$exam->id)->latest()->paginate(5);
        return view('teacher.show-exam', compact('exam','questions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacherId = Auth::user()->teacher->id;
        $courses = Course::where('teacher_id', $teacherId)->get();
        $exam = Exam::findOrFail($id);
        return view('teacher.edit-exam', compact('exam', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $exam = Exam::findOrfail($id);

        $request->validate([
            'exam_name' => [ 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'course' => [ 'exists:courses,id'],
            'total_questions' => ['integer', 'min:1'],
            'passing_score' => ['integer', 'min:1'],
            'duration' => ['integer', 'min:1'],
            'start_time' => ['date_format:Y-m-d H:i'],
            'end_time' => ['date_format:Y-m-d H:i'],

        ]);

        $exam->name = $request->exam_name;
        $exam->course_id = $request->courses;
        $exam->description = $request->description;
        $exam->total_questions = $request->total_questions;
        $exam->passing_score = $request->passing_score;
        $exam->duration = $request->duration;
        $exam->start_time = $request->start_time;
        $exam->end_time = $request->end_time;

        $exam->save();

        return Redirect::route('exams.edit', $exam->id)->with('status', 'profile-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return redirect()->route('exams.index');
    }

    public function Trashed()
    {
        $exams = Exam::onlyTrashed()->paginate(4);

        return view('teacher.trashed-exams', compact('exams'));
    }

    public function restore($id)
    {

        $exam = Exam::onlyTrashed()->findOrFail($id);
        $exam->restore();

        return redirect()->route('exams.index');
    }
    public function forceDelete($id)
    {
        $exam = Exam::onlyTrashed()->findOrFail($id);
        $exam->forceDelete();
        return redirect()->route('exams.index');
    }
}
