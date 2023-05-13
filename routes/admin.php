<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseQuestionController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\LessonQuestionController;
use App\Http\Controllers\Admin\LessonTaskController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::get('', [MainController::class, 'index'])->name('index');
Route::resource('questions', QuestionController::class)->except('show')->names('questions');
Route::resource('users', UserController::class)->except('show')->names('users');
Route::get('users/{id}/access-courses', [UserController::class, 'userAccessCourses'])->name('users.access_courses');
Route::post('users/{id}/access-courses', [UserController::class, 'userAccessCoursesGive'])->name('users.access_course_give');
Route::delete('users/{id}/access-courses/{access_id}', [UserController::class, 'userAccessCoursesDelete'])->name('users.access_course_delete');
Route::post('users/{id}/change-role', [UserController::class, 'changeRole'])->name('users.change_role');
//Route::get('courses/lessons/{id}/files/{number}', [LessonController::class, 'deleteFile'])->name('lessons.delete_file');
//Route::resource('courses/{id}/modules', ModuleController::class)->names('modules');
//Route::resource('courses/{course}/modules/{module}/lessons', LessonController::class)->except('show')->names('lessons');
//Route::resource('courses/{id}/questions', CourseQuestionController::class)->names('courses.questions');

Route::get('courses/{course}/tasks', [LessonTaskController::class,'list'])->name('courses.all_tasks');
Route::put('courses/{course}/tasks/{task}', [LessonTaskController::class,'updateCourse'])->name('courses.update_task');

Route::resource('courses.modules', ModuleController::class)->except('show')->names('modules');
Route::resource('courses.modules.lessons', LessonController::class)->except('show')->names('lessons');
Route::resource('courses.modules.lessons.questions', LessonQuestionController::class)->except('show')->names('lessons.questions');
Route::resource('courses.modules.lessons.tasks', LessonTaskController::class)->only(['index', 'update', 'destroy'])->names('lessons.tasks');
Route::get('courses/{course}/modules/{module}/lessons/{lesson}/files/{number}', [LessonController::class, 'deleteFile'])->name('lessons.delete_file');

Route::resource('courses', CourseController::class)->except('show')->names('courses');
Route::resource('comments', CommentController::class)->except('show', 'create', 'store')->names('comments');
