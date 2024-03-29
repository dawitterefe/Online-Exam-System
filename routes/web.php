<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserCourseController;
use App\Http\Controllers\Evaluator\ExamEvaluationController;
use App\Http\Controllers\Teacher\ExamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\ExamController as StudentExamController;
use App\Http\Controllers\teacher\QuestionController;
use App\Http\Controllers\Teacher\ResultAndStatusController;

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
    Route::get('/students/{id}/show-student-courses', [UserCourseController::class, 'showStudentCourses'])->name('admin.show_student_courses');



    Route::get('/teachers', [UserCourseController::class, 'showTeachers'])->name('admin.teachers');
    Route::get('/teachers/{id}/assign-course', [UserCourseController::class, 'showTeacherCourses'])->name('admin.show_teacher_courses');
    Route::get('/teachers/{id}/add-course', [UserCourseController::class, 'assignTeacherCourses'])->name('admin.assign_teacher_courses');
    Route::get('/teachers/{techer_id}/{course_id}/remove-course', [UserCourseController::class, 'removeTeacherCourses'])->name('admin.remove_courses');

    Route::get('/evaluators', [UserCourseController::class, 'showEvaluators'])->name('admin.evaluators');
    Route::get('/evaluators/{id}/assign-course', [UserCourseController::class, 'showEvaluatorCourses'])->name('admin.show_evaluator_courses');
    Route::get('/evaluators/{id}/add-course', [UserCourseController::class, 'assignEvaluatorCourses'])->name('admin.assign_evaluator_courses');
    Route::get('/evaluators/{evaluator_id}/{course_id}/detach-course', [UserCourseController::class, 'detachEvaluatorCourses'])->name('admin.detach_evaluator_courses');

    Route::get('/sections/{id}/add-course', [SectionController::class, 'assignSectionCourses'])->name('admin.assign_section_courses');
    Route::get('/sections/{section_id}/{course_id}/detach-course', [SectionController::class, 'detachStudentCourses'])->name('admin.detach_section_courses');
    Route::get('/sections/{id}/add-student', [SectionController::class, 'addStudents'])->name('admin.add_students');
    Route::get('/sections/{id}/{section_id}/remove-student-section', [SectionController::class, 'removeStudentSection'])->name('admin.remove_student_section');

    Route::get('/sections/trash', [SectionController::class, 'trashed'])->name('sections.trashed');
    Route::get('/sections/{id}/restore', [SectionController::class, 'restore'])->name('sections.restore');
    Route::delete('/sections/{id}/force-delete', [SectionController::class, 'forceDelete'])->name('sections.force_delete');
    Route::resource('/sections', SectionController::class);
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

    Route::get('/exams-result', [ResultAndStatusController::class, 'showExams'])->name('exams.result');
    Route::get('/exam-results/{id}', [ResultAndStatusController::class, 'showExamResults'])->name('exam.results');

    Route::get('/exams-status', [ResultAndStatusController::class, 'showExamStatuses'])->name('exams.status');
    Route::get('/exam-statuses/{id}', [ResultAndStatusController::class, 'showExamStatus'])->name('exam.statuses');
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
    Route::get('/student-exams', [StudentExamController::class, 'index'])->name('student.exams');
    Route::get('/student-exam/{id}/info', [StudentExamController::class, 'showExamInfo'])->name('student.show');
    Route::get('/student-exam/{id}', [StudentExamController::class, 'showExam'])->name('student.exam');
    Route::post('/student-submit-exam/{id}', [StudentExamController::class, 'submitExam'])->name('student.submit-exam');
    Route::get('/student-exam-results', [StudentExamController::class, 'showResults'])->name('student.exam-results');
    Route::get('/send-remaining-time/{remaining_time}/exam-id/{exam_id}', [StudentExamController::class, 'sendRemainingTime'])->name('send-remaining-time');
});








require __DIR__ . '/auth.php';
