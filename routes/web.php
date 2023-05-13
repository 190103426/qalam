<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseTestController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonTestController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCourseController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MainController::class, 'index'])->name('index');

Route::get('/login', fn() => redirect()->route('index'))->name('login');
Route::get('/register', fn() => redirect()->route('index'))->name('register');


Route::resource('courses', CourseController::class)->only('index', 'show');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [UserController::class, 'changePassword'])->name('profile.change_password');
    Route::post('/profile/upload-image', [UserController::class, 'uploadImage'])->name('profile.upload_image');
    Route::get('/user/courses', [UserCourseController::class, 'index'])->name('user.courses');

    Route::resource('courses.modules.lessons', LessonController::class)->only('show');

    Route::get('courses/{course}/lessons/{lesson}/test', [LessonTestController::class, 'index'])->name('lessons.test.index');
    Route::post('courses/{course}/lessons/{lesson}/test', [LessonTestController::class, 'store'])->name('lessons.test.store');
    Route::get('courses/{course}/lessons/{lesson}/test/{uuid}', [LessonTestController::class, 'show'])->name('lessons.test.show');
    Route::get('courses/{course}/lessons/{lesson}/test/{uuid}/result', [LessonTestController::class, 'result'])->name('lessons.test.result');
    Route::get('courses/{course}/lessons/{lesson}/test/{uuid}/work-mistake', [LessonTestController::class, 'workMistake'])->name('lessons.test.workMistake');
    Route::post('courses/{course}/lessons/{lesson}/test/{uuid}/finish', [LessonTestController::class, 'finish'])->name('lessons.test.finish');
//    Route::resource('courses.lessons', LessonController::class)->only('show')->names('lessons');
//    Route::post('courses/{course}/lessons/{lesson}/comment', [LessonController::class, 'commentSave'])->name('lessons.commentSave')->middleware('auth');
//    Route::post('courses/{course}/lessons/{lesson}/task', [LessonController::class, 'taskStore'])->name('lessons.taskStore')->middleware('auth');

    Route::post('courses/{course}/lessons/{lesson}/task', [LessonController::class, 'taskStore'])->name('lessons.taskStore')->middleware('auth');
    Route::post('courses/lessons/{id}/comment', [LessonController::class, 'commentSave'])->name('lessons.commentSave')->middleware('auth');
});

Route::get('questions', [QuestionController::class, 'index'])->name('questions');

Route::prefix('ajax')->group(function () {
    Route::post('login', [AuthController::class, 'loginAjax'])->name('login.ajax');
    Route::post('reset-password-email', [AuthController::class, 'resetPasswordSendEmail'])->name('reset_password.ajax');
    Route::post('register', [AuthController::class, 'registerAjax'])->name('register.ajax');
});
Route::prefix('password')->group(function () {
    Route::get('reset/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('reset', [AuthController::class, 'resetPasswordUpdate'])->name('password.update');

});
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('download-file', [DownloadController::class, 'downloadFile'])->name('downloadFile');
