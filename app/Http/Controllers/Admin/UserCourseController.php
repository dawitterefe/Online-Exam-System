<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserCourseController extends Controller
{
    public function showStudent()
    {
        $students = Student::latest()->paginate(4);
        return view('admin.students', compact('students'));
    }
 // show assign course page
    public function showAssignCourse(string $id)
    {

        $student = Student::findOrFail($id);
        $courses = Course::whereNotIn('id', $student->courses->pluck('id'))->get();
        return view('admin.assign-course', compact('student','courses'));
    }


    public function assignCourse(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        $student->courses()->attach($request->input('courses'));

        return Redirect::route('admin.show_assign_course', $student->id)->with('status', 'profile-updated');

    }
    public function detachCourse(Request $request, string $student_id, string $course_id)
    {
        $student = Student::findOrFail($student_id);
        $student->courses()->detach($course_id);

        return Redirect::route('admin.show_assign_course', $student->id)->with('status', 'profile-updated');

    }
}
