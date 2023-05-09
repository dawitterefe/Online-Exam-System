<?php

namespace App\Http\Controllers\Evaluator;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamReview;
use App\Models\Question;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamEvaluationController extends Controller
{
    public function index()
    {

        $evaluator = auth()->user()->evaluator;
        $courses = $evaluator->courses;
        $exams = Exam::whereIn('course_id', $courses->pluck('id'))->latest()->paginate(4);
        return view('evaluator.exams', compact('exams'));
        // return $exams;
    }

    public function show(string $id)
    {
        $exam = Exam::findOrFail($id);
        $reviews = $exam->evaluations()->where('exam_id', $exam->id)->get();


        $evaluator_id = Auth::user()->evaluator->id;
        $already_approved = $exam->evaluations()->wherePivot('evaluator_id', $evaluator_id)->exists();
        $questions =  Question::where('exam_id', $exam->id)->latest()->paginate(4);
        return view('evaluator.show-exam', compact('exam', 'questions', 'reviews', 'already_approved'));
    }


    public function setApprovalStatus(Request $request, string $id)
    {
        $exam = Exam::findOrFail($id);
        $evaluator = Auth::user()->evaluator->id;

        $request->validate([
            'review' => 'required|max:500',
            'approval' => 'required',
        ]);

        if ($exam->questions->first() !== null) {
            ExamReview::create([
                'exam_id' => $exam->id,
                'evaluator_id' => $evaluator,
                'review' => $request->review,
            ]);
        }

        if ($request->approval == 1 && $exam->questions->first() !== null) {

            $exam->evaluations()->updateExistingPivot($evaluator, ['approved' => true]);
            return redirect()->back()->with('status', 'sent');
        } else {
            return redirect()->back()->with('status', 'no_questions');
        }
    }


    public function destroy(string $id)
    {
        $review = ExamReview::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('status', 'deleted');
    }
}
