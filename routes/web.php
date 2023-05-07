<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserCourseController;
use App\Http\Controllers\Evaluator\ExamEvaluationController;
use App\Http\Controllers\Teacher\ExamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\ExamController as StudentExamController;
use App\Http\Controllers\teacher\QuestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ADMIN ROUTES
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::view('/admin', 'admin.dashboard')->name('admin.dashboard');
    Route::get('/users/trash', [UserController::class, 'trashed'])->name('users.trashed');
    Route::get('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.force_delete');
    Route::resource('/users', UserController::class);

    Route::get('/courses/trash', [CourseController::class, 'trashed'])->name('courses.trashed');
    Route::get('/courses/{id}/restore', [CourseController::class, 'restore'])->name('courses.restore');
    Route::delete('/courses/{id}/force-delete', [CourseController::class, 'forceDelete'])->name('courses.force_delete');
    Route::resource('/courses', CourseController::class);

    Route::get('/students', [UserCourseController::class, 'showStudents'])->name('admin.students');
    Route::get('/students/{id}/assign-course', [UserCourseController::class, 'showStudentCourses'])->name('admin.show_student_courses');
    Route::get('/students/{id}/add-course', [UserCourseController::class, 'assignStudentCourses'])->name('admin.assign_student_courses');
    Route::get('/students/{student_id}/{course_id}/detach-course', [UserCourseController::class, 'detachStudentCourses'])->name('admin.detach_student_courses');

    Route::get('/teachers', [UserCourseController::class, 'showTeachers'])->name('admin.teachers');
    Route::get('/teachers/{id}/assign-course', [UserCourseController::class, 'showTeacherCourses'])->name('admin.show_teacher_courses');
    Route::get('/teachers/{id}/add-course', [UserCourseController::class, 'assignTeacherCourses'])->name('admin.assign_teacher_courses');
    Route::get('/teachers/{techer_id}/{course_id}/remove-course', [UserCourseController::class, 'removeTeacherCourses'])->name('admin.remove_courses');

    Route::get('/evaluators', [UserCourseController::class, 'showEvaluators'])->name('admin.evaluators');
    Route::get('/evaluators/{id}/assign-course', [UserCourseController::class, 'showEvaluatorCourses'])->name('admin.show_evaluator_courses');
    Route::get('/evaluators/{id}/add-course', [UserCourseController::class, 'assignEvaluatorCourses'])->name('admin.assign_evaluator_courses');
    Route::get('/evaluators/{evaluator_id}/{course_id}/detach-course', [UserCourseController::class, 'detachEvaluatorCourses'])->name('admin.detach_evaluator_courses');
});

// TEACHER ROUTES
Route::middleware(['auth', 'role:teacher'])->group(function () {

    Route::view('/teacher', 'teacher.dashboard')->name('teacher.dashboard');
    Route::get('/exams/trash', [ExamController::class, 'trashed'])->name('exams.trashed');
    Route::get('/exams/{id}/restore', [ExamController::class, 'restore'])->name('exams.restore');
    Route::delete('/exams/{id}/force-delete', [ExamController::class, 'forceDelete'])->name('exams.force_delete');
    Route::resource('/exams', ExamController::class);

    Route::get('/question/{id}/create', [QuestionController::class, 'create'])->name('question.create');
    Route::post('/question', [QuestionController::class, 'store'])->name('question.store');
    Route::delete('/question/{id}/delete', [QuestionController::class, 'destroy'])->name('question.destroy');
    Route::get('/question/{question_id}/{exam_id}/edit', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('/question/{id}/update', [QuestionController::class, 'update'])->name('question.update');

    Route::get('/exam/{id}/activate', [ExamController::class, 'activate'])->name('exam.activate');
    Route::get('/exam/{id}/deactivate', [ExamController::class, 'deactivate'])->name('exam.deactivate');
});


// EVALUATOR ROUTES
Route::middleware(['auth', 'role:evaluator'])->group(function () {
    Route::view('/evaluator', 'evaluator.dashboard')->name('evaluator.dashboard');
    Route::get('/exam-review', [ExamEvaluationController::class, 'index'])->name('exam-review.index');
    Route::get('/exam-review/{id}', [ExamEvaluationController::class, 'show'])->name('exam-review.show');
    Route::get('/exam-approval/{id}', [ExamEvaluationController::class, 'setApprovalStatus'])->name('exam-review.approval');
    Route::get('/exam-review/{id}/destroy', [ExamEvaluationController::class, 'destroy'])->name('exam-review.destroy');
});


// STUDENT ROUTES
Route::middleware(['auth', 'role:student'])->group(function () {

    Route::view('/student', 'student.dashboard')->name('student.dashboard');
    Route::get('/student-exam', [StudentExamController::class, 'index'])->name('student.exams');
});








require __DIR__ . '/auth.php';
