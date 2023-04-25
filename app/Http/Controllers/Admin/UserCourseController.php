<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserCourseController extends Controller
{
    public function showStudents()
    {
        $students = Student::latest()->paginate(4);
        return view('admin.students', compact('students'));
    }
    public function showTeachers()
    {
        $teachers = Teacher::latest()->paginate(4);
        return view('admin.teachers', compact('teachers'));
    }
    // show assign course page
    public function showAssignCourse(string $id)
    {

        $student = Student::findOrFail($id);
        $courses = Course::whereNotIn('id', $student->courses->pluck('id'))->get();
        return view('admin.assign-course', compact('student', 'courses'));
    }

    public function assignCourse(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        $student->courses()->attach($request->input('courses'));

        return Redirect::route('admin.show_assign_course', $student->id)->with('status', 'profile-updated');
    }

    public function showAssignTeacherCourse(string $id)
    {

        $teacher = Teacher::findOrFail($id);
        $courses = Course::whereNotIn('id', $teacher->courses->pluck('id'))->get();
        return view('admin.assign-teacher-course', compact('teacher', 'courses'));
    }

    public function assignTeacherCourse(Request $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);

        $courseIds = $request->input('courses');

        foreach ($courseIds as $courseId) {
            $course = Course::findOrFail($courseId);
            $course->teacher()->associate($teacher);
            $course->save();
        }
        // dd('sucess');
        return Redirect::route('admin.show_assign_teacher_course', $teacher->id)->with('status', 'profile-updated');
    }


    public function detachCourse(Request $request, string $student_id, string $course_id)
    {
        $student = Student::findOrFail($student_id);
        $student->courses()->detach($course_id);

        return Redirect::route('admin.show_assign_course', $student->id)->with('status', 'profile-updated');
    }

    public function removeTeacherCourse(Request $request, string $teacher_id, string $course_id)
    {
        $teacher = Teacher::findOrFail($teacher_id);
        $course = Course::findOrFail($course_id);
        // $courseId = $request->input('courses');
        $course->teacher()->dissociate($teacher);
        $course->save();

        // dd('sucess');
        return Redirect::route('admin.show_assign_teacher_course', $teacher->id)->with('status', 'profile-updated');
    }

}
