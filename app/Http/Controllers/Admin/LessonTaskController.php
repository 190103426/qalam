<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonTask;
use App\Services\AccessLessonService;
use App\Services\FileService;
use Illuminate\Http\Request;

class LessonTaskController extends Controller
{
    public function list($courseId, Request $request)
    {
        $lessonId = $request->lesson_id;
        $fullName = $request->full_name;
        $phone = $request->phone;
        $email = $request->email;
        $result = $request->result;
        $tasks = LessonTask::with(['user', 'lesson.module'])
            ->whereHas('lesson', fn($query) => $query->where('course_id', $courseId))
            ->latest()
            ->when($lessonId, fn($query) => $query->where('lesson_id', $lessonId))
            ->when($fullName, function($query) use ($fullName) {
                return $query->whereHas('user', fn($query) => $query->where('full_name', 'like', "%$fullName%"));
            })
            ->when($phone, function($query) use ($phone) {
                return $query->whereHas('user', fn($query) => $query->where('phone', 'like', "%$phone%"));
            })
            ->when($email, function($query) use ($email) {
                return $query->whereHas('user', fn($query) => $query->where('email', 'like', "%$email%"));
            })
            ->when($result && $result != 'not-selected', function($query) use ($result) {
                return $query->where('result',$result);
            })
            ->when($result && $result == 'not-selected', function($query) use ($result) {
                return $query->whereNull('result');
            })
            ->paginate(20)
            ->appends($request->except('page'));
        $course = Course::findOrFail($courseId);
        return view('admin.courses.tasks', compact('tasks', 'course'));
    }

    public function index($courseId, $moduleId, $lessonId)
    {
        $lesson = Lesson::with(['tasks' => fn($query) => $query->latest()->with('user'), 'module.course'])
            ->moduleBy($moduleId)
            ->findOrFail($lessonId);
        return view('admin.lessons.tasks', compact('lesson'));
    }

    public function updateCourse($courseId, $taskId, Request $request)
    {
        $task = LessonTask::with('lesson.module')->findOrFail($taskId);
        $task->comment_teacher = $request->comment_teacher;
        $task->result = $request->result;
        $task->save();
        if ($task->result == LessonTask::SUCCESS_RESULT) {
            AccessLessonService::openAccessUser((int)$task->lesson->course_id, (int)$task->lesson->id, $task->user);
        }
        return redirect()->back()->withSuccess(__('message.success.saved'));
    }

    public function update($courseId, $moduleId, $lessonId, $taskId, Request $request)
    {
        $task = LessonTask::lessonBy($lessonId)->findOrFail($taskId);
        $task->comment_teacher = $request->comment_teacher;
        $task->result = $request->result;
        $task->save();
        if ($task->result == LessonTask::SUCCESS_RESULT) {
            AccessLessonService::openAccessUser((int)$courseId, (int)$lessonId, $task->user);
        }
        return redirect()->back()->withSuccess(__('message.success.saved'));
    }

    public function destroy($courseId, $moduleId, $lessonId, $taskId)
    {
        $task = LessonTask::lessonBy($lessonId)->findOrFail($taskId);
        if ($task->file_1) {
            FileService::deleteFile($task->file_1, LessonTask::FILES_PATH);
        }
        if ($task->file_2) {
            FileService::deleteFile($task->file_2, LessonTask::FILES_PATH);
        }
        if ($task->file_3) {
            FileService::deleteFile($task->file_3, LessonTask::FILES_PATH);
        }
        $task->delete();
        return redirect()->back()->withSuccess(__('message.success.deleted'));
    }
}
