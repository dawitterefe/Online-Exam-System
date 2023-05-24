<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::latest()->paginate(4);
        return view('admin.sections', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create-section');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'year' => ['required', 'integer',],
            'semester' => ['required', 'string', 'max:25'],
            'program' => ['required', 'string', 'max:56'],
            'degree_level' => ['required', 'string', 'max:56'],
            'type' => ['required', 'string', 'max:25'],
        ]);

        $section = Section::create([
            'name' => $request->name,
            'year' => $request->year,
            'semester' => $request->semester,
            'program' => $request->program,
            'degree_level' => $request->degree_level,
            'type' => $request->type,
        ]);

        return redirect()->route('sections.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $section = Section::findOrFail($id);
        $courses = Course::whereNotIn('id', $section->courses->pluck('id'))->get();
        $students = Student::where('section_id', $section->id)->latest()->paginate(5);
        $students_without_section = Student::where('section_id', null)->latest()->paginate(5);

        return view('admin.show-section', compact('section', 'courses', 'students', 'students_without_section'));
    }

    /**
     * Attach Courses to a section.
     */
    public function assignSectionCourses(Request $request, string $id)
    {
        $section = Section::findOrFail($id);
        $section->courses()->attach($request->input('courses'));

        $courses = request()->input('courses');
        $students = Student::where('section_id', $section->id);

        $students->each(function ($student) use ($courses) {
            $student->courses()->syncWithoutDetaching($courses);
        });

        return Redirect::route('sections.show', $section->id)->with('status', 'courses-attached');
    }
    /**
     * Add student(s) to a section.
     */
    public function addStudents(Request $request, string $id)
    {
        $section = Section::findOrFail($id);
        $students_without_section = $request->students_without_section;
        $courses = $section->courses;

        foreach ($students_without_section as $student_without_section) {

            $student = Student::findOrFail($student_without_section);
            $student->section_id = $section->id;
            $student->save();

            $student->courses()->attach($courses);
        }

        return Redirect::route('sections.show', $section->id)->with('status', 'courses-attached');
    }

    /**
     * Detach Courses to a section.
     */
    public function detachStudentCourses(Request $request, string $section_id, string $course_id)
    {
        $section = Section::findOrFail($section_id);
        $section->courses()->detach($course_id);

        $students = Student::where('section_id', $section->id);

        $students->each(function ($student) use ($course_id) {
            $student->courses()->detach($course_id);
        });

        return Redirect::route('sections.show', $section->id)->with('status', 'courses-detached');
    }
    /**
     * Remove Student section.
     */
    public function removeStudentSection(string $id, string $section_id)
    {
        $student = Student::findOrFail($id);
        $student->section_id = Null;
        $student->save();

        $section = Section::findOrFail($section_id);
        $courses = $section->courses;
        $student->courses()->detach($courses);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $section = Section::findOrFail($id);
        return view('admin.edit-section', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $section = Section::findOrFail($id);

        $rules = [
            'name' => ['string', 'max:25'],
            'year' => ['integer',],
            'semester' => ['string', 'max:25'],
            'program' => ['string', 'max:56'],
            'degree_level' => ['string', 'max:56'],
            'type' => ['string', 'max:25'],
        ];



        $section->name = $request->name;
        $section->year = $request->year;
        $section->semester = $request->semester;
        $section->program = $request->program;
        $section->degree_level = $request->degree_level;
        $section->type = $request->type;

        $section->save();

        return Redirect::route('sections.edit', $section->id)->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        return redirect()->route('sections.index');
    }

    public function Trashed()
    {
        $sections = Section::onlyTrashed()->paginate(4);

        return view('admin.trashed-sections', compact('sections'));
    }

    public function restore($id)
    {

        $section = Section::onlyTrashed()->findOrFail($id);
        $section->restore();

        return redirect()->route('sections.index');
    }
    public function forceDelete($id)
    {
        $section = Section::onlyTrashed()->findOrFail($id);

        $section->forceDelete();

        return redirect()->route('sections.index');
    }
}
