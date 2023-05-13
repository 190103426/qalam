<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentSaveRequest;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonTask;
use App\Services\FileService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function show($courseId, $moduleId, $id)
    {

        $lesson = Lesson::with(['comments'=>fn($query) => $query->with(['user', 'reply' => fn($query) => $query->whereNotNull('parent_id')->with('user')])
            ->orderByDesc('id')])
//            ->with('task')
            ->with('module.course')
            ->withCount('comments')->findOrFail($id);

//        dd($lesson->task);

        $course = Course::has('accessCourseThisUser')
            ->with('accessCourseThisUser')
            ->findOrFail($courseId);
        if(empty($course->accessCourseThisUser) || (isset($course->accessCourseThisUser->to_date) && $course->accessCourseThisUser->to_date < now())) {
            return redirect()->route('courses.index');
        }
        $lesson->module->setRelation('course', $course);

        $task = LessonTask::where('lesson_id', $lesson->id)
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->first();
        return view('client.courses.lessons.show', compact('lesson','task'));
    }


    public function taskStore($courseId, $id, Request $request)
    {
        if (!$request->hasFile('file_1')) {
            return redirect()->back()->withErrors(['file_1' => 'Файл жүктеңіз']);
        }
        $lesson = Lesson::findOrFail($id);

        $task = new LessonTask();
        $task->user_id = auth()->user()->id;
        if ($request->hasFile('file_1')) {
            $task->file_1 = FileService::saveFile($request->file('file_1'), LessonTask::FILES_PATH . "/$lesson->id");
        }
        $task->comment = $request->comment;

        $lesson->tasks()->save($task);
        return redirect()->back()->withSuccess(__('message.success.sent'));
    }

    public function commentSave($id, CommentSaveRequest $request)
    {
        $lesson = Lesson::findOrFail($id);
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->text = $request->text;
        $comment->parent_id = $request->comment_id;

        $lesson->comments()->save($comment);
        return redirect()->back()->withSuccess('Пікір сәтті сақталды');
    }
}
