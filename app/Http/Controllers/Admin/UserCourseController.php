<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Evaluator;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserCourseController extends Controller
{

    // Students Course Control
    public function showStudents()
    {
        $students = Student::latest()->paginate(4);
        return view('admin.students', compact('students'));
    }

    public function showStudentCourses(string $id)
    {

        $student = Student::findOrFail($id);
        $courses = Course::whereNotIn('id', $student->courses->pluck('id'))->get();
        return view('admin.student-course', compact('student', 'courses'));
    }

    public function assignStudentCourses(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        $student->courses()->attach($request->input('courses'));

        return Redirect::route('admin.show_student_courses', $student->id)->with('status', 'profile-updated');
    }

    public function detachStudentCourses(Request $request, string $student_id, string $course_id)
    {
        $student = Student::findOrFail($student_id);
        $student->courses()->detach($course_id);

        return Redirect::route('admin.show_student_courses', $student->id)->with('status', 'profile-updated');
    }


    // Techers Course Control

    public function showTeachers()
    {
        $teachers = Teacher::latest()->paginate(4);
        return view('admin.teachers', compact('teachers'));
    }

    public function showTeacherCourses(string $id)
    {

        $teacher = Teacher::findOrFail($id);
        $courses = Course::whereNotIn('id', $teacher->courses->pluck('id'))->get();
        return view('admin.teacher-course', compact('teacher', 'courses'));
    }

    public function assignTeacherCourses(Request $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);

        $courseIds = $request->input('courses');

        foreach ($courseIds as $courseId) {
            $course = Course::findOrFail($courseId);
            $course->teacher()->associate($teacher);
            $course->save();
        }
        // dd('sucess');
        return Redirect::route('admin.show_teacher_courses', $teacher->id)->with('status', 'profile-updated');
    }

    public function removeTeacherCourses(Request $request, string $teacher_id, string $course_id)
    {
        $teacher = Teacher::findOrFail($teacher_id);
        $course = Course::findOrFail($course_id);
        // $courseId = $request->input('courses');
        $course->teacher()->dissociate($teacher);
        $course->save();

        // dd('sucess');
        return Redirect::route('admin.show_teacher_courses', $teacher->id)->with('status', 'profile-updated');
    }



    // Evaluators Course Control
    public function showEvaluators()
    {
        $evaluators = Evaluator::latest()->paginate(4);
        return view('admin.evaluators', compact('evaluators'));
    }

    public function showEvaluatorCourses(string $id)
    {

        $evaluator = Evaluator::findOrFail($id);
        $courses = Course::whereNotIn('id', $evaluator->courses->pluck('id'))->get();
        return view('admin.evaluator-course', compact('evaluator', 'courses'));
    }

    public function assignEvaluatorCourses(Request $request, string $id)
    {
        $evaluator = Evaluator::findOrFail($id);
        $evaluator->courses()->attach($request->input('courses'));

        return Redirect::route('admin.show_evaluator_courses', $evaluator->id)->with('status', 'profile-updated');
    }

    public function detachEvaluatorCourses(Request $request, string $evaluator_id, string $course_id)
    {
        $evaluator = Evaluator::findOrFail($evaluator_id);
        $evaluator->courses()->detach($course_id);

        return Redirect::route('admin.show_evaluator_courses', $evaluator->id)->with('status', 'profile-updated');
    }
}
