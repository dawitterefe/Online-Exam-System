<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::latest()->paginate(4);
        return view('admin.courses', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create-course');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_code' => ['required', 'string', 'unique:courses', 'max:56'],
            'title' => ['required', 'string', 'max:100'],
            'credit_hour' => ['required', 'integer'],
        ], ['course_code.unique' => 'This course code already exists.',]);


        $request->validate(
            [
                'course_code' => 'required|unique:courses,course_code',
            ],
            ['course_code.unique' => 'This course code already exists.',]
        );

        $course = Course::create([
            'course_code' => $request->course_code,
            'course_title' => $request->title,
            'credit_hour' => $request->credit_hour,
        ]);

        return redirect()->route('courses.index');
        // return $course;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = course::findOrFail($id);
        return view('admin.show-course', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = course::findOrFail($id);
        return view('admin.edit-course', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);

        $rules = [
            'title' => ['required', 'string', 'max:100'],
            'credit_hour' => ['required', 'integer'],
        ];

        // Adding the course_code validation rule conditionally
        if ($request->course_code != $course->course_code) {
            $rules['course_code'] = ['required', 'string', 'unique:courses', 'max:56'];
        }
        $request->validate($rules, ['course_code.unique' => 'This course code already exists.']);

        $course->course_code = $request->course_code;
        $course->course_title = $request->title;
        $course->credit_hour = $request->credit_hour;
        $course->save();

        return Redirect::route('courses.edit', $course->id)->with('status', 'profile-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('courses.index');
    }

    public function Trashed()
    {
        $courses = Course::onlyTrashed()->paginate(4);

        return view('admin.trashed-course', compact('courses'));
    }

    public function restore($id)
    {

        $course = Course::onlyTrashed()->findOrFail($id);
        $course->restore();

        return redirect()->route('courses.index');
    }
    public function forceDelete($id)
    {
        $course = Course::onlyTrashed()->findOrFail($id);

        $course->forceDelete();

        return redirect()->route('courses.index');
    }
}
