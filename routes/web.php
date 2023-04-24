<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserCourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::view('/admin', 'admin.dashboard')->name('admin.dashboard');
    Route::get('/users/trash',[UserController::class, 'trashed'])->name('users.trashed');
    Route::get('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.force_delete');
    Route::resource('/users', UserController::class);

    Route::get('/courses/trash',[CourseController::class, 'trashed'])->name('courses.trashed');
    Route::get('/courses/{id}/restore', [CourseController::class, 'restore'])->name('courses.restore');
    Route::delete('/courses/{id}/force-delete', [CourseController::class, 'forceDelete'])->name('courses.force_delete');
    Route::resource('/courses', CourseController::class);

    Route::get('/students',[UserCourseController::class,'showStudent'])->name('admin.students');
    Route::get('/students/{id}/assign-course',[UserCourseController::class,'showAssignCourse'])->name('admin.show_assign_course');
    Route::get('/students/{id}/add-course',[UserCourseController::class,'assignCourse'])->name('admin.assign_course');
    Route::get('/students/{student_id}/{course_id}/detach-course',[UserCourseController::class,'detachCourse'])->name('admin.detach_course');





});

Route::middleware(['auth', 'role:student'])->group(function () {

    Route::view('/student', 'student.dashboard')->name('student.dashboard');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {

    Route::view('/teacher', 'teacher.dashboard')->name('teacher.dashboard');
});

Route::middleware(['auth', 'role:evaluator'])->group(function () {

    Route::view('/evaluator', 'evaluator.dashboard')->name('evaluator.dashboard');
});





























// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
